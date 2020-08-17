export const state = () => ({
  auth: {
    busy: false,
    loggedIn: false,
    strategy: "local",
    user: null,
  },
});

export const actions = {
  login({}, payload) {
    this.$auth
      .loginWith("laravelSanctum", { data: payload.form })
      .then(() => {
        this.$router.push("/");
      })
      .catch((err) => {
        payload.$refs.observer.setErrors(err.response.data.errors);
      });
  },
  logout() {
    this.$auth.logout();
  },
};

export const getters = {
  autenticated(state) {
    return state.auth.loggedIn;
  },
  user(state) {
    return state.auth.user;
  },
};
