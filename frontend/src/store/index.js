import { createStore } from 'vuex'
import { User } from "../services";

export default createStore({
  modules: {
    auth: {
      state: {
        user: localStorage.user ? JSON.parse(localStorage.getItem('user')) : null
      },

      getters: {
        user: state => state.user,
        authenticated: state => state.user !== null,
      },

      mutations: {
        SET_USER(state, user) {
          state.user = user;
        },
      },

      actions: {
        async login({ commit }, user) {
          await User.createSession();
          const { data } = await User.login(user);
          
          commit('SET_USER', data)

          localStorage.user = JSON.stringify(data);
        },

        async logout() {
          await User.logout();
          localStorage.removeItem('user');

          location.reload()
        }
      }
    }
  }
})
