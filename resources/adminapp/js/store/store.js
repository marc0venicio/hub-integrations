import Vue from 'vue'
import Vuex from 'vuex'

import Alert from './modules/alert'
import I18NStore from './modules/i18n'

import PermissionsIndex from './cruds/Permissions'
import PermissionsSingle from './cruds/Permissions/single'
import RolesIndex from './cruds/Roles'
import RolesSingle from './cruds/Roles/single'
import UsersIndex from './cruds/Users'
import UsersSingle from './cruds/Users/single'
import PlansIndex from './cruds/Plans'
import PlansSingle from './cruds/Plans/single'
import ShopsIndex from './cruds/Shops'
import ShopsSingle from './cruds/Shops/single'
import ProductsIndex from './cruds/Products'
import ProductsSingle from './cruds/Products/single'
import OrdersIndex from './cruds/Orders'
import OrdersSingle from './cruds/Orders/single'
import SubscriptionsIndex from './cruds/Subscriptions'
import SubscriptionsSingle from './cruds/Subscriptions/single'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    Alert,
    I18NStore,
    PermissionsIndex,
    PermissionsSingle,
    RolesIndex,
    RolesSingle,
    UsersIndex,
    UsersSingle,
    PlansIndex,
    PlansSingle,
    ShopsIndex,
    ShopsSingle,
    ProductsIndex,
    ProductsSingle,
    OrdersIndex,
    OrdersSingle,
    SubscriptionsIndex,
    SubscriptionsSingle
  },
  strict: debug
})
