<template>
  <div class="p-6 bg-indigo-800 min-h-screen flex justify-center items-center">
    <div class="w-full max-w-md">
      
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="submit">
        <div class="px-10 py-12">
          <h1 class="text-center uppercase font-bold text-3xl">Tattoo Collection</h1>          
          <!-- <h2 class="text-center text-2xl">Добро пожаловать!</h2> -->
          <div class="mx-auto mt-6 w-24 border-b-2" />
          <text-input v-model="form.email" :errors="$page.errors.email" class="mt-10" label="Email" type="email" autofocus autocapitalize="off" />
          <text-input v-model="form.password" class="mt-6" label="Пароль" type="password" />
          <label class="mt-6 select-none flex items-center" for="remember">
            <input id="remember" v-model="form.remember" class="mr-1" type="checkbox">
            <span class="text-sm">Запомнить</span>
          </label>
        </div>
        <div class="px-10 py-4 bg-gray-100 border-t border-gray-200 flex justify-between items-center">
<!--           <a class="hover:underline" tabindex="-1" href="#reset-password">Забыли пароль?</a> -->
          <loading-button :loading="sending" class="btn-indigo" type="submit">Войти</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import LoadingButton from '@/Shared/LoadingButton'
import TextInput from '@/Shared/TextInput'

export default {
  metaInfo: { title: 'Login' },
  components: {
    LoadingButton,
    TextInput,
  },
  props: {
    errors: Object,
    mytoken: String,
  },
  data() {
    return {
      sending: false,
      form: {
        email: '',
        password: '',
        remember: null,
      },
    }
  },
  methods: {
    submit() {
      this.sending = true
      this.$inertia.post('login', {
        email: this.form.email,
        password: this.form.password,
        remember: this.form.remember,
        
      }).then(() => this.sending = false)
    },
  },
/*   created() {

    if(token_csrf != this.mytoken) {
      location.reload();
    }

  } */  
}
</script>
