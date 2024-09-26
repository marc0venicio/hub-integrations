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
                <strong>{{ $t('cruds.plan.title_singular') }}</strong>
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
                      $t('cruds.plan.fields.name')
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
                      $t('cruds.plan.fields.description')
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
                      $t('cruds.plan.fields.price')
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
                      'has-items': entry.billing_cycle,
                      'is-focused': activeField == 'billing_cycle'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.plan.fields.billing_cycle')
                    }}</label>
                    <v-select
                      name="billing_cycle"
                      :key="'billing_cycle-field'"
                      :value="entry.billing_cycle"
                      :options="lists.billing_cycle"
                      :reduce="entry => entry.value"
                      @input="updateBillingCycle"
                      @search.focus="focusField('billing_cycle')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.feature,
                      'is-focused': activeField == 'feature'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.plan.fields.feature')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.feature"
                      @input="updateFeature"
                      @focus="focusField('feature')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.trial_period_days,
                      'is-focused': activeField == 'trial_period_days'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.plan.fields.trial_period_days')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="1"
                      :value="entry.trial_period_days"
                      @input="updateTrialPeriodDays"
                      @focus="focusField('trial_period_days')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div class="form-group">
                    <label class="required">{{
                      $t('cruds.plan.fields.active')
                    }}</label>
                    <v-radio
                      :value="entry.active"
                      :options="lists.active"
                      @change="updateActive"
                    >
                    </v-radio>
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
    //   mock: [
    //     { label: 'Yes', value: true },
    //     { label: 'No', value: false },
    //   ],
      activeField: ''
    }
  },
  computed: {
    ...mapGetters('PlansSingle', ['entry', 'loading', 'lists'])
  },
  mounted() {
    this.fetchCreateData()
  },
  beforeDestroy() {
    this.resetState()
  },
  methods: {
    ...mapActions('PlansSingle', [
      'storeData',
      'resetState',
      'setName',
      'setDescription',
      'setPrice',
      'setBillingCycle',
      'setFeature',
      'setTrialPeriodDays',
      'setActive',
      'fetchCreateData'
    ]),
    updateName(e) {
      this.setName(e.target.value)
    },
    updateDescription(e) {
      this.setDescription(e.target.value)
    },
    updatePrice(e) {
      this.setPrice(e.target.value)
    },
    updateBillingCycle(value) {
      this.setBillingCycle(value)
    },
    updateFeature(e) {
      this.setFeature(e.target.value)
    },
    updateTrialPeriodDays(e) {
      this.setTrialPeriodDays(e.target.value)
    },
    updateActive(value) {
      this.setActive(value)
    },
    submitForm() {
      this.storeData()
        .then(() => {
          this.$router.push({ name: 'plans.index' })
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
