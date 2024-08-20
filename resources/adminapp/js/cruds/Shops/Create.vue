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
                <strong>{{ $t('cruds.shop.title_singular') }}</strong>
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
                      'has-items': entry.name,
                      'is-focused': activeField == 'name'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.shop.fields.name')
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
                      'has-items': entry.platform,
                      'is-focused': activeField == 'platform'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.shop.fields.platform')
                    }}</label>
                    <v-select
                      name="platform"
                      :key="'platform-field'"
                      :value="entry.platform"
                      :options="lists.platform"
                      :reduce="entry => entry.value"
                      @input="updatePlatform"
                      @search.focus="focusField('platform')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.api_key,
                      'is-focused': activeField == 'api_key'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.shop.fields.api_key')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.api_key"
                      @input="updateApiKey"
                      @focus="focusField('api_key')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.api_secret,
                      'is-focused': activeField == 'api_secret'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.shop.fields.api_secret')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.api_secret"
                      @input="updateApiSecret"
                      @focus="focusField('api_secret')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.access_token,
                      'is-focused': activeField == 'access_token'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.shop.fields.access_token')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.access_token"
                      @input="updateAccessToken"
                      @focus="focusField('access_token')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.refresh_token,
                      'is-focused': activeField == 'refresh_token'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.shop.fields.refresh_token')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.refresh_token"
                      @input="updateRefreshToken"
                      @focus="focusField('refresh_token')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.expires_at,
                      'is-focused': activeField == 'expires_at'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.shop.fields.expires_at')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.expires_at"
                      @input="updateExpiresAt"
                      @focus="focusField('expires_at')"
                      @blur="clearFocus"
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
    ...mapGetters('ShopsSingle', ['entry', 'loading', 'lists'])
  },
  mounted() {
    this.fetchCreateData()
  },
  beforeDestroy() {
    this.resetState()
  },
  methods: {
    ...mapActions('ShopsSingle', [
      'storeData',
      'resetState',
      'setName',
      'setPlatform',
      'setApiKey',
      'setApiSecret',
      'setAccessToken',
      'setRefreshToken',
      'setExpiresAt',
      'fetchCreateData'
    ]),
    updateName(e) {
      this.setName(e.target.value)
    },
    updatePlatform(value) {
      this.setPlatform(value)
    },
    updateApiKey(e) {
      this.setApiKey(e.target.value)
    },
    updateApiSecret(e) {
      this.setApiSecret(e.target.value)
    },
    updateAccessToken(e) {
      this.setAccessToken(e.target.value)
    },
    updateRefreshToken(e) {
      this.setRefreshToken(e.target.value)
    },
    updateExpiresAt(e) {
      this.setExpiresAt(e.target.value)
    },
    submitForm() {
      this.storeData()
        .then(() => {
          this.$router.push({ name: 'shops.index' })
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
