<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('users')">Пользователи</inertia-link>
      <span class="text-indigo-400 font-medium">/</span> Создать
    </h1>
    <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.first_name" :errors="$page.errors.first_name" class="pr-6 pb-8 w-full lg:w-1/2" label="Имя" />
          <text-input v-model="form.last_name" :errors="$page.errors.last_name" class="pr-6 pb-8 w-full lg:w-1/2" label="Фамилия" />
          <text-input v-model="form.telegram_user_id" :errors="$page.errors.telegram_user_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Телеграм ID" />
          <text-input v-model="form.email" :errors="$page.errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
          <text-input v-model="form.password" :errors="$page.errors.password" class="pr-6 pb-8 w-full lg:w-1/2" type="password" autocomplete="new-password" label="Пароль" />
          <select-input v-model="form.owner" :errors="$page.errors.owner" class="pr-6 pb-8 w-full lg:w-1/2" label="Роль">
            <option :value="1">Admin</option>
            <option :value="2">SMM</option>
            <option :value="3">Marketing</option>
          </select-input>
          <!-- <file-input v-model="form.photo" :errors="$page.errors.photo" class="pr-6 pb-8 w-full lg:w-1/2" type="file" accept="image/*" label="Фото" /> -->
        </div>
        <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
          <loading-button :loading="sending" class="btn-indigo text-white hover:bg-red-600 focus:bg-red-600" type="submit">Сохранить</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton'
import SelectInput from '@/Shared/SelectInput'
import TextInput from '@/Shared/TextInput'
/* import FileInput from '@/Shared/FileInput' */

export default {
  metaInfo: { title: 'Создать пользователя' },
  layout: Layout,
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
/*     FileInput, */
  },
  remember: 'form',
  data() {
    return {
      sending: false,
      form: {
        first_name: null,
        last_name: null,
        telegram_user_id: null,
        email: null,
        password: null,
        owner: 1,
        photo: null,
      },
    }
  },
  methods: {
    submit() {
      this.sending = true

      var data = new FormData()
      data.append('first_name', this.form.first_name || '')
      data.append('last_name', this.form.last_name || '')
      data.append('telegram_user_id', this.form.telegram_user_id || '')
      data.append('email', this.form.email || '')
      data.append('password', this.form.password || '')
      data.append('owner', this.form.owner || '')
      data.append('photo', this.form.photo || '')

      this.$inertia.post(this.route('users.store'), data)
        .then(() => this.sending = false)
    },
  },
}
</script>
