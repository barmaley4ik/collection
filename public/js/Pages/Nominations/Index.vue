<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Номинации</h1>
    <div class="mb-6 flex justify-end items-center">

      <inertia-link class="btn-indigo text-white hover:bg-red-600 focus:bg-red-600" :href="route('nominations.create')">
        <span>Создать</span>
      </inertia-link>
    </div>
    <div class="bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">#</th>
          <th class="px-6 pt-6 pb-4" colspan="3">День</th>
          <th class="px-6 pt-6 pb-4">Фестиваль</th>

          <th class="px-6 pt-6 pb-4"></th>
        </tr>
        <tr v-for="(nomination, index) in nominations.data" :key="nomination.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t px-6 py-4 w-2">
          {{index +1}}
          </td>
          <td class="border-t " colspan="3" v-html="nomination.day">
          </td>
          <td class="border-t ">
            <div v-if="nomination.festival">
              {{ JSON.parse(nomination.festival.name)[defaultlocale] }}
            </div>
              
          </td> 
                              
          <td class="flex pt-3 justify-end border-t">
            <inertia-link class="px-4" :href="route('nominations.edit', nomination.id)" tabindex="-1">
              <icon name="edit" class="block w-6 h-6 fill-green-600" />
            </inertia-link>
            <button
              class="px-4"
              @click.prevent ="showModal(nomination.id)">
                  <icon name="trash" class="block w-6 h-6 fill-red-600" />
            </button>
          </td>          
        </tr>
        <tr v-if="nominations.data.length === 0">
          <td class="border-t px-6 py-4" colspan="6">Нет записей</td>
        </tr>
      </table>
    </div>
    <pagination :links="nominations.links" />
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
import Pagination from '@/Shared/Pagination'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import ModalConfirm from '@/Shared/ModalConfirm'
export default {
  metaInfo: { title: 'Номинации' },
  layout: Layout,
  components: {
    Icon,
    Pagination,
    ModalConfirm
  },
  props: {
    nominations: Object,
  },
  data() {
    return {
      open: false,
      record_id: '',
    }
  },
  watch: {
    form: {
      handler: throttle(function() {
        let query = pickBy(this.form)
        this.$inertia.replace(this.route('nominations', Object.keys(query).length ? query : { remember: 'forget' }))
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
        this.$inertia.delete(this.route('nominations.destroy', this.record_id))
    },    
  },
}
</script>
