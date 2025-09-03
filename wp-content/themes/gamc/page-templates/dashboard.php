<?php
/* Template Name: Dashboard Frontend */

if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}

get_header();
$current_user = wp_get_current_user();
?>

<!-- AdminLTE CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="wrapper">

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo home_url(); ?>" class="brand-link">
      <span class="brand-text font-weight-light">Mi Sistema</span>
    </a>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <li class="nav-item">
            <a href="<?php echo site_url('/mi-panel'); ?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo wp_logout_url(); ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Salir</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper p-4">

    <!-- Header -->
    <div class="content-header">
      <div class="container-fluid">
        <h1>Bienvenido, <?php echo esc_html($current_user->display_name); ?> 👋</h1>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Tarjeta 1: Editar Perfil -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Editar Perfil</h3>
          </div>
          <div class="card-body">
            <?php 
            acf_form(array(
                'post_id'       => 'user_' . get_current_user_id(), // Guarda en el usuario actual
                'field_groups'  => array(18), // ID del grupo de campos que quieres guardar
                'form_attributes' => array(
                    'id' => 'acf_form_dashboard', // ID del formulario
                    'class' => 'acf-form'
                ),
                'submit_value'  => 'Guardar Cambios',
                'return'        => site_url('/mi-panel'), // Redirige después de enviar
                'html_before_fields' => '<div class="acf-fields-wrapper">',
                'html_after_fields'  => '</div>'
            ));
                        ?>
          </div>
        </div>

        <!-- Tarjeta 2: Lista de posts del usuario -->
        <div class="card card-info mt-3">
          <div class="card-header">
            <h3 class="card-title">Tus Entradas</h3>
          </div>
          <div class="card-body">
            <?php
            $posts = get_posts(array(
                'author' => $current_user->ID,
                'numberposts' => 5
            ));
            if($posts):
            ?>
            <ul class="list-group">
              <?php foreach($posts as $post): ?>
                <li class="list-group-item">
                  <a href="<?php echo get_edit_post_link($post->ID); ?>"><?php echo esc_html($post->post_title); ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
            <?php else: ?>
              <p>No tienes entradas publicadas.</p>
            <?php endif; ?>
          </div>
        </div>

        <!-- Tarjeta 3: Subida de imágenes -->
        <div class="card card-success mt-3">
          <div class="card-header">
            <h3 class="card-title">Subir Imagen</h3>
          </div>
          <div class="card-body">
            <?php
            acf_form(array(
                'post_id'       => 'user_' . $current_user->ID,
                'field_groups'  => array(456), // Cambia por el ID de tu grupo de campos que tenga el campo imagen
                'submit_value'  => 'Subir Imagen',
                'return'        => site_url('/mi-panel')
            ));
            ?>
          </div>
        </div>

        <!-- Tarjeta 4: Estadísticas simples -->
        <div class="row mt-3">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo count_user_posts($current_user->ID); ?></h3>
                <p>Entradas publicadas</p>
              </div>
              <div class="icon">
                <i class="fas fa-pencil-alt"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo count_user_posts($current_user->ID, 'page'); ?></h3>
                <p>Páginas creadas</p>
              </div>
              <div class="icon">
                <i class="fas fa-file-alt"></i>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>
</div>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<?php get_footer(); ?>
