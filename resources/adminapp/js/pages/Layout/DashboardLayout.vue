<template>
  <div class="wrapper" :class="{ 'nav-open': $sidebar.showSidebar }">
    <event-hub></event-hub>
    <side-bar :sidebarLinks="sidebarLinks">
      <mobile-menu slot="content"></mobile-menu>
    </side-bar>

    <div class="main-panel">
      <top-navbar></top-navbar>
      <div class="content">
        <dashboard-content></dashboard-content>
      </div>
    </div>
  </div>
</template>

<script>
import DashboardContent from './Content.vue'
import TopNavbar from './TopNavbar.vue'
import MobileMenu from './MobileMenu.vue'

export default {
  components: {
    DashboardContent,
    TopNavbar,
    MobileMenu
  },
  data() {
    return {
      sidebarLinks: [
        {
          title: 'global.dashboard',
          icon: 'dashboard',
          path: { name: 'dashboard' }
        },
        {
          title: 'cruds.userManagement.title',
          icon: 'person',
          path: { name: 'user_management' },
          gate: 'user_management_access',
          children: [
            {
              title: 'cruds.permission.title',
              icon: 'perm_data_setting',
              path: { name: 'permissions.index' },
              gate: 'permission_access'
            },
            {
              title: 'cruds.role.title',
              icon: 'group',
              path: { name: 'roles.index' },
              gate: 'role_access'
            },
            {
              title: 'cruds.user.title',
              icon: 'person',
              path: { name: 'users.index' },
              gate: 'user_access'
            }
          ]
        },
        {
          title: 'cruds.plan.title',
          icon: 'table_view',
          path: { name: 'plans.index' },
          gate: 'plan_access'
        },
        {
          title: 'cruds.shop.title',
          icon: 'table_view',
          path: { name: 'shops.index' },
          gate: 'shop_access'
        },
        {
          title: 'cruds.product.title',
          icon: 'table_view',
          path: { name: 'products.index' },
          gate: 'product_access'
        },
        {
          title: 'cruds.order.title',
          icon: 'table_view',
          path: { name: 'orders.index' },
          gate: 'order_access'
        },
        {
          title: 'cruds.subscription.title',
          icon: 'table_view',
          path: { name: 'subscriptions.index' },
          gate: 'subscription_access'
        }
      ]
    }
  }
}
</script>
