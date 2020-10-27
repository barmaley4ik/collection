<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Пользователи</h1>
    <div class="mb-6 flex justify-between items-center">
      <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
        <label class="block text-gray-700">Роли:</label>
        <select v-model="form.role" class="mt-1 w-full form-select">
          <option :value="null" />
          <option value="SMM">SMM</option>
          <option value="Admin">Admin</option>
          <option value="Marketing">Marketing</option>
        </select>
        <label class="mt-4 block text-gray-700">Корзина:</label>
        <select v-model="form.trashed" class="mt-1 w-full form-select">
          <option :value="null" />
          <option value="with">С удаленными</option>
          <option value="only">Только удаленные</option>
        </select>
      </search-filter>
      <inertia-link class="btn-indigo text-white hover:bg-red-600 focus:bg-red-600" :href="route('users.create')">
        <span>Создать</span>
      </inertia-link>
    </div>
    <div class="bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">Имя</th>
          <th class="px-6 pt-6 pb-4">Email</th>
          <th class="px-6 pt-6 pb-4">Роль</th>
          <th class="px-6 pt-6 pb-4" colspan="2"></th>
        </tr>
        <tr v-for="user in users" :key="user.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('users.edit', user.id)">
              <img v-if="user.photo" class="block w-5 h-5 rounded-full mr-2 -my-2" :src="user.photo">
              {{ user.name }}
              <icon v-if="user.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('users.edit', user.id)" tabindex="-1">
              {{ user.email }}
            </inertia-link>
          </td>
          <td class="border-t">
            <span v-if="user.owner === 1">
              Admin
            </span>
            <span v-else-if="user.owner === 2">
              SMM
            </span>
            <span v-else-if="user.owner === 3">
              Marketing
            </span>
            <span v-else></span>            
          </td>
          <td class="flex pt-3 justify-end border-t">
            <inertia-link class="px-4" :href="route('users.edit', user.id)" tabindex="-1">
              <icon name="edit" class="block w-6 h-6 fill-green-600" />
            </inertia-link>
            <button
              class="px-4"
              @click.prevent ="showModal(user.id)">
                  <icon name="trash" class="block w-6 h-6 fill-red-600" />
            </button>
          </td>           
<!--           <td class="border-t w-px">
            <inertia-link class="px-4 flex items-center" :href="route('users.edit', user.id)" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </inertia-link>
          </td> -->
        </tr>
        <tr v-if="users.length === 0">
          <td class="border-t px-6 py-4" colspan="4">Нет записей.</td>
        </tr>
      </table>
    </div>
     <modal-confirm :showing="open" @close="open = false">
       <h2 class="text-xl font-bold text-gray-900 h-10 pt-6 mb-10">Вы дейсвительно хотите удалить запись?</h2>
      <div class="flex justify-end">
        <button
          class="justify-end bg-indigo-600 text-white h-10 px-4 py-2 text-sm tracking-wide font-bold rounded"
          @click="open=false" >
          Отмена
        </button>
        <button class="inline-flex justify-end bg-red-600 text-white h-10 ml-5 px-4 py-2 text-sm tracking-wide font-bold rounded"
        @click="destroy">
          <span class="block">Подтвердить</span>
        </button>
      </div>        
     </modal-confirm>    
  </div>
</template>

<script>
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import mapValues from 'lodash/mapValues'
import pickBy from 'lodash/pickBy'
import SearchFilter from '@/Shared/SearchFilter'
import throttle from 'lodash/throttle'
import ModalConfirm from '@/Shared/ModalConfirm'

export default {
 
  metaInfo: { title: 'Пользователи' },
  layout: Layout,
  components: {
    Icon,
    SearchFilter,
    ModalConfirm,
  },
  props: {
    users: Array,
    filters: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        role: this.filters.role,
        trashed: this.filters.trashed,
      },
      open: false,
      record_id: '',      
    }
  },
  watch: {
    form: {
      handler: throttle(function() {
        let query = pickBy(this.form)
        this.$inertia.replace(this.route('users', Object.keys(query).length ? query : { remember: 'forget' }))
      }, 150),
      deep: true,
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
    showModal(id){
      this.open = true;
      this.record_id= id;
    },
    destroy() {
        this.$inertia.delete(this.route('users.destroy', this.record_id))
    },       
  },
}
</script>
