<?php
/* Template Name: Dashboard Frontend */

if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}

get_header();
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
            <a href="<?php echo site_url('/mi-perfil'); ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Perfil</p>
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
        <h1>Bienvenido, <?php echo wp_get_current_user()->display_name; ?> 👋</h1>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Ejemplo de widget con ACF Frontend -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Editar Perfil</h3>
          </div>
          <div class="card-body">
            <?php echo do_shortcode('[acf_frontend form="formulario_dashboard"]'); ?>
          </div>
        </div>

        <!-- Ejemplo de lista de posts -->
        <div class="card card-info mt-3">
          <div class="card-header">
            <h3 class="card-title">Tus Entradas</h3>
          </div>
          <div class="card-body">
            <?php
            $posts = get_posts(['author' => get_current_user_id(), 'numberposts' => 5]);
            if ($posts):
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

      </div>
    </section>
  </div>

</div>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<?php get_footer(); ?>
