  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url('dashboard')?>" class="brand-link">
      <img src="<?=base_url()?>assets/images/logo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8;">
      <span class="brand-text font-weight-light">B.E.D distribution</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url($user['user_image'])?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=@$this->session->userdata('fullname')?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <?php $curent = $this->uri->segment(2)==''?$this->uri->segment(1): $this->uri->segment(1).'/'.$this->uri->segment(2);?>
          <!--  -->
          <?php foreach (get_label_menu() as $keys => $label):?>
          <li class="nav-header"><?=$label['category_name']?></li>
          <?php foreach (get_menu($label['category_id']) as $key => $menu): ?>
          <?php if (!$menu['parent_id']): ?>
          <?php $has_submenu = (count(get_submenu($menu['menu_id']))>0)?true:false; ?>
          <li id="<?=$menu['url']?>" class="nav-item <?=($has_submenu)?'has-treeview':''?>">
            <a href="<?=base_url().$menu['url']?>" class="nav-link<?=($curent==$menu['url'])?' active':'';?>">
              <i class="<?=$menu['icon']?> nav-icon"></i>
              <p><?=$menu['title']?></p>
              <?=($has_submenu)?'<i class="right fas fa-angle-left"></i>':''?>
            </a>
            <?php if ($has_submenu): ?>
            <ul class="nav nav-treeview">
              <?php foreach (get_submenu($menu['menu_id']) as $key_sub => $sub): ?>
              <li class="nav-item">
                <a href="<?=base_url().$sub['url']?>" class="nav-link<?=($curent==$sub['url'])?' active':'';?> submenu">
                  <i class="<?=$sub['icon']?> nav-icon"></i>
                  <p><?=$sub['title']?></p>
                </a>
              </li>
              <?php endforeach ?>
            </ul>
            <?php endif ?>
          </li>
          <?php endif ?>
          <?php endforeach ?>
          <?php endforeach;?>
          
          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="https://ilyanazalun.github.io/projects/7-inventory-management-project" target="_blank" class="nav-link active bg-danger">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>