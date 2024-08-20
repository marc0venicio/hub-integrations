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
                <strong>{{ $t('cruds.product.title_singular') }}</strong>
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
                      $t('cruds.product.fields.shop')
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
                      'has-items': entry.name,
                      'is-focused': activeField == 'name'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.product.fields.name')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.name"
                      @input="updateName"
                      @focus="focusField('name')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.description,
                      'is-focused': activeField == 'description'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.product.fields.description')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.description"
                      @input="updateDescription"
                      @focus="focusField('description')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.price,
                      'is-focused': activeField == 'price'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.product.fields.price')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="0.01"
                      :value="entry.price"
                      @input="updatePrice"
                      @focus="focusField('price')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.stok,
                      'is-focused': activeField == 'stok'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.product.fields.stok')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="1"
                      :value="entry.stok"
                      @input="updateStok"
                      @focus="focusField('stok')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.sku,
                      'is-focused': activeField == 'sku'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.product.fields.sku')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.sku"
                      @input="updateSku"
                      @focus="focusField('sku')"
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
                      $t('cruds.product.fields.external')
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
    ...mapGetters('ProductsSingle', ['entry', 'loading', 'lists'])
  },
  mounted() {
    this.fetchCreateData()
  },
  beforeDestroy() {
    this.resetState()
  },
  methods: {
    ...mapActions('ProductsSingle', [
      'storeData',
      'resetState',
      'setShop',
      'setName',
      'setDescription',
      'setPrice',
      'setStok',
      'setSku',
      'setExternal',
      'fetchCreateData'
    ]),
    updateShop(value) {
      this.setShop(value)
    },
    updateName(e) {
      this.setName(e.target.value)
    },
    updateDescription(e) {
      this.setDescription(e.target.value)
    },
    updatePrice(e) {
      this.setPrice(e.target.value)
    },
    updateStok(e) {
      this.setStok(e.target.value)
    },
    updateSku(e) {
      this.setSku(e.target.value)
    },
    updateExternal(e) {
      this.setExternal(e.target.value)
    },
    submitForm() {
      this.storeData()
        .then(() => {
          this.$router.push({ name: 'products.index' })
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
