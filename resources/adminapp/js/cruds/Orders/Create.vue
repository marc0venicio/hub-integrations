<template>
  <div class="container-fluid">
    <form @submit.prevent="submitForm">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">add</i>
              </div>
              <h4 class="card-title">
                {{ $t('global.create') }}
                <strong>{{ $t('cruds.order.title_singular') }}</strong>
              </h4>
            </div>
            <div class="card-body">
              <back-button></back-button>
            </div>
            <div class="card-body">
              <bootstrap-alert />
              <div class="row">
                <div class="col-md-12">
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.shop_id !== null,
                      'is-focused': activeField == 'shop'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.order.fields.shop')
                    }}</label>
                    <v-select
                      name="shop"
                      label="name"
                      :key="'shop-field'"
                      :value="entry.shop_id"
                      :options="lists.shop"
                      :reduce="entry => entry.id"
                      @input="updateShop"
                      @search.focus="focusField('shop')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.order_number,
                      'is-focused': activeField == 'order_number'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.order.fields.order_number')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.order_number"
                      @input="updateOrderNumber"
                      @focus="focusField('order_number')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.status,
                      'is-focused': activeField == 'status'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.order.fields.status')
                    }}</label>
                    <v-select
                      name="status"
                      :key="'status-field'"
                      :value="entry.status"
                      :options="lists.status"
                      :reduce="entry => entry.value"
                      @input="updateStatus"
                      @search.focus="focusField('status')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.total_amount,
                      'is-focused': activeField == 'total_amount'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.order.fields.total_amount')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="0.01"
                      :value="entry.total_amount"
                      @input="updateTotalAmount"
                      @focus="focusField('total_amount')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.external,
                      'is-focused': activeField == 'external'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.order.fields.external')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.external"
                      @input="updateExternal"
                      @focus="focusField('external')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <vue-button-spinner
                class="btn-primary"
                :status="status"
                :isLoading="loading"
                :disabled="loading"
              >
                {{ $t('global.save') }}
              </vue-button-spinner>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  data() {
    return {
      status: '',
      activeField: ''
    }
  },
  computed: {
    ...mapGetters('OrdersSingle', ['entry', 'loading', 'lists'])
  },
  mounted() {
    this.fetchCreateData()
  },
  beforeDestroy() {
    this.resetState()
  },
  methods: {
    ...mapActions('OrdersSingle', [
      'storeData',
      'resetState',
      'setShop',
      'setOrderNumber',
      'setStatus',
      'setTotalAmount',
      'setExternal',
      'fetchCreateData'
    ]),
    updateShop(value) {
      this.setShop(value)
    },
    updateOrderNumber(e) {
      this.setOrderNumber(e.target.value)
    },
    updateStatus(value) {
      this.setStatus(value)
    },
    updateTotalAmount(e) {
      this.setTotalAmount(e.target.value)
    },
    updateExternal(e) {
      this.setExternal(e.target.value)
    },
    submitForm() {
      this.storeData()
        .then(() => {
          this.$router.push({ name: 'orders.index' })
          this.$eventHub.$emit('create-success')
        })
        .catch(error => {
          this.status = 'failed'
          _.delay(() => {
            this.status = ''
          }, 3000)
        })
    },
    focusField(name) {
      this.activeField = name
    },
    clearFocus() {
      this.activeField = ''
    }
  }
}
</script>
