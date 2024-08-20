<template>
  <div class="container-fluid">
    <form @submit.prevent="submitForm">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">edit</i>
              </div>
              <h4 class="card-title">
                {{ $t('global.edit') }}
                <strong>{{ $t('cruds.subscription.title_singular') }}</strong>
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
                      'has-items': entry.user_id !== null,
                      'is-focused': activeField == 'user'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.subscription.fields.user')
                    }}</label>
                    <v-select
                      name="user"
                      label="name"
                      :key="'user-field'"
                      :value="entry.user_id"
                      :options="lists.user"
                      :reduce="entry => entry.id"
                      @input="updateUser"
                      @search.focus="focusField('user')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.plan_id !== null,
                      'is-focused': activeField == 'plan'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.subscription.fields.plan')
                    }}</label>
                    <v-select
                      name="plan"
                      label="name"
                      :key="'plan-field'"
                      :value="entry.plan_id"
                      :options="lists.plan"
                      :reduce="entry => entry.id"
                      @input="updatePlan"
                      @search.focus="focusField('plan')"
                      @search.blur="clearFocus"
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
                      $t('cruds.subscription.fields.status')
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
                      'has-items': entry.started_at,
                      'is-focused': activeField == 'started_at'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.subscription.fields.started_at')
                    }}</label>
                    <datetime-picker
                      class="form-control"
                      type="text"
                      :value="entry.started_at"
                      @input="updateStartedAt"
                      @focus="focusField('started_at')"
                      @blur="clearFocus"
                      required
                    >
                    </datetime-picker>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.expires_at,
                      'is-focused': activeField == 'expires_at'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.subscription.fields.expires_at')
                    }}</label>
                    <datetime-picker
                      class="form-control"
                      type="text"
                      :value="entry.expires_at"
                      @input="updateExpiresAt"
                      @focus="focusField('expires_at')"
                      @blur="clearFocus"
                    >
                    </datetime-picker>
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
    ...mapGetters('SubscriptionsSingle', ['entry', 'loading', 'lists'])
  },
  beforeDestroy() {
    this.resetState()
  },
  watch: {
    '$route.params.id': {
      immediate: true,
      handler() {
        this.resetState()
        this.fetchEditData(this.$route.params.id)
      }
    }
  },
  methods: {
    ...mapActions('SubscriptionsSingle', [
      'fetchEditData',
      'updateData',
      'resetState',
      'setUser',
      'setPlan',
      'setStatus',
      'setStartedAt',
      'setExpiresAt'
    ]),
    updateUser(value) {
      this.setUser(value)
    },
    updatePlan(value) {
      this.setPlan(value)
    },
    updateStatus(value) {
      this.setStatus(value)
    },
    updateStartedAt(e) {
      this.setStartedAt(e.target.value)
    },
    updateExpiresAt(e) {
      this.setExpiresAt(e.target.value)
    },
    submitForm() {
      this.updateData()
        .then(() => {
          this.$router.push({ name: 'subscriptions.index' })
          this.$eventHub.$emit('update-success')
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
