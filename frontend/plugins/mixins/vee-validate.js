import Vue from "vue";
import { ValidationObserver, ValidationProvider } from "vee-validate";

Vue.mixin({
  components: {
    ValidationObserver,
    ValidationProvider,
  },
  methods: {
    resetFormVeeValidate(_vm) {
      _vm.form = {};
      _vm.$nextTick(() => {
        if (_vm.$refs.observer) {
          _vm.$refs.observer.reset();
        }
      });
    },
  },
});
