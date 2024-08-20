import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const View = { template: '<router-view></router-view>' }

const routes = [
  {
    path: '/',
    component: () => import('@pages/Layout/DashboardLayout.vue'),
    redirect: 'dashboard',
    children: [
      {
        path: 'dashboard',
        name: 'dashboard',
        component: () => import('@pages/Dashboard.vue'),
        meta: { title: 'global.dashboard' }
      },
      {
        path: 'user-management',
        name: 'user_management',
        component: View,
        redirect: { name: 'permissions.index' },
        children: [
          {
            path: 'permissions',
            name: 'permissions.index',
            component: () => import('@cruds/Permissions/Index.vue'),
            meta: { title: 'cruds.permission.title' }
          },
          {
            path: 'permissions/create',
            name: 'permissions.create',
            component: () => import('@cruds/Permissions/Create.vue'),
            meta: { title: 'cruds.permission.title' }
          },
          {
            path: 'permissions/:id',
            name: 'permissions.show',
            component: () => import('@cruds/Permissions/Show.vue'),
            meta: { title: 'cruds.permission.title' }
          },
          {
            path: 'permissions/:id/edit',
            name: 'permissions.edit',
            component: () => import('@cruds/Permissions/Edit.vue'),
            meta: { title: 'cruds.permission.title' }
          },
          {
            path: 'roles',
            name: 'roles.index',
            component: () => import('@cruds/Roles/Index.vue'),
            meta: { title: 'cruds.role.title' }
          },
          {
            path: 'roles/create',
            name: 'roles.create',
            component: () => import('@cruds/Roles/Create.vue'),
            meta: { title: 'cruds.role.title' }
          },
          {
            path: 'roles/:id',
            name: 'roles.show',
            component: () => import('@cruds/Roles/Show.vue'),
            meta: { title: 'cruds.role.title' }
          },
          {
            path: 'roles/:id/edit',
            name: 'roles.edit',
            component: () => import('@cruds/Roles/Edit.vue'),
            meta: { title: 'cruds.role.title' }
          },
          {
            path: 'users',
            name: 'users.index',
            component: () => import('@cruds/Users/Index.vue'),
            meta: { title: 'cruds.user.title' }
          },
          {
            path: 'users/create',
            name: 'users.create',
            component: () => import('@cruds/Users/Create.vue'),
            meta: { title: 'cruds.user.title' }
          },
          {
            path: 'users/:id',
            name: 'users.show',
            component: () => import('@cruds/Users/Show.vue'),
            meta: { title: 'cruds.user.title' }
          },
          {
            path: 'users/:id/edit',
            name: 'users.edit',
            component: () => import('@cruds/Users/Edit.vue'),
            meta: { title: 'cruds.user.title' }
          }
        ]
      },
      {
        path: 'plans',
        name: 'plans.index',
        component: () => import('@cruds/Plans/Index.vue'),
        meta: { title: 'cruds.plan.title' }
      },
      {
        path: 'plans/create',
        name: 'plans.create',
        component: () => import('@cruds/Plans/Create.vue'),
        meta: { title: 'cruds.plan.title' }
      },
      {
        path: 'plans/:id',
        name: 'plans.show',
        component: () => import('@cruds/Plans/Show.vue'),
        meta: { title: 'cruds.plan.title' }
      },
      {
        path: 'plans/:id/edit',
        name: 'plans.edit',
        component: () => import('@cruds/Plans/Edit.vue'),
        meta: { title: 'cruds.plan.title' }
      },
      {
        path: 'shops',
        name: 'shops.index',
        component: () => import('@cruds/Shops/Index.vue'),
        meta: { title: 'cruds.shop.title' }
      },
      {
        path: 'shops/create',
        name: 'shops.create',
        component: () => import('@cruds/Shops/Create.vue'),
        meta: { title: 'cruds.shop.title' }
      },
      {
        path: 'shops/:id',
        name: 'shops.show',
        component: () => import('@cruds/Shops/Show.vue'),
        meta: { title: 'cruds.shop.title' }
      },
      {
        path: 'shops/:id/edit',
        name: 'shops.edit',
        component: () => import('@cruds/Shops/Edit.vue'),
        meta: { title: 'cruds.shop.title' }
      },
      {
        path: 'products',
        name: 'products.index',
        component: () => import('@cruds/Products/Index.vue'),
        meta: { title: 'cruds.product.title' }
      },
      {
        path: 'products/create',
        name: 'products.create',
        component: () => import('@cruds/Products/Create.vue'),
        meta: { title: 'cruds.product.title' }
      },
      {
        path: 'products/:id',
        name: 'products.show',
        component: () => import('@cruds/Products/Show.vue'),
        meta: { title: 'cruds.product.title' }
      },
      {
        path: 'products/:id/edit',
        name: 'products.edit',
        component: () => import('@cruds/Products/Edit.vue'),
        meta: { title: 'cruds.product.title' }
      },
      {
        path: 'orders',
        name: 'orders.index',
        component: () => import('@cruds/Orders/Index.vue'),
        meta: { title: 'cruds.order.title' }
      },
      {
        path: 'orders/create',
        name: 'orders.create',
        component: () => import('@cruds/Orders/Create.vue'),
        meta: { title: 'cruds.order.title' }
      },
      {
        path: 'orders/:id',
        name: 'orders.show',
        component: () => import('@cruds/Orders/Show.vue'),
        meta: { title: 'cruds.order.title' }
      },
      {
        path: 'orders/:id/edit',
        name: 'orders.edit',
        component: () => import('@cruds/Orders/Edit.vue'),
        meta: { title: 'cruds.order.title' }
      },
      {
        path: 'subscriptions',
        name: 'subscriptions.index',
        component: () => import('@cruds/Subscriptions/Index.vue'),
        meta: { title: 'cruds.subscription.title' }
      },
      {
        path: 'subscriptions/create',
        name: 'subscriptions.create',
        component: () => import('@cruds/Subscriptions/Create.vue'),
        meta: { title: 'cruds.subscription.title' }
      },
      {
        path: 'subscriptions/:id',
        name: 'subscriptions.show',
        component: () => import('@cruds/Subscriptions/Show.vue'),
        meta: { title: 'cruds.subscription.title' }
      },
      {
        path: 'subscriptions/:id/edit',
        name: 'subscriptions.edit',
        component: () => import('@cruds/Subscriptions/Edit.vue'),
        meta: { title: 'cruds.subscription.title' }
      }
    ]
  }
]

export default new VueRouter({
  mode: 'history',
  base: '/admin',
  routes
})
