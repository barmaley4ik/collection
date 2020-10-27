<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Заявки на участие</h1>
    <div class="mb-6 flex justify-between items-center">
      <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
        <label class="block text-gray-700">Статус:</label>
        <select v-model="form.status" class="mt-1 w-full form-select">
          <option :value="null" />
          <option value="1">Новая</option>
          <option value="2">Ожидаем оплату</option>
          <option value="3">Оплачена</option>
          <option value="4">Отменена</option>
        </select>
      </search-filter>
    
      <inertia-link class="btn-indigo text-white hover:bg-red-600 focus:bg-red-600" :href="route('proposals.create')">
        <span>Создать</span>
      </inertia-link>
    </div>
    <div class="bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">#</th>
          <th class="px-2 pt-6 pb-4">Участник</th>
          <th class="px-2 pt-6 pb-4">Студия</th>          
          <th class="px-2 pt-6 pb-4">Специализация</th>
          <th class="px-2 pt-6 pb-4">Страна</th>
          <th class="px-2 pt-6 pb-4">Фестиваль</th>
          <th class="px-2 pt-6 pb-4">Дата</th>
          <th class="px-2 pt-6 pb-4">Статус</th>
          <th class="px-2 pt-6 pb-4">№ места</th>
          <th class="px-2 pt-6 pb-4"></th>
        </tr>
        <tr v-for="(proposal, index) in proposals.data" :key="proposal.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t px-6 py-4 w-2">
          {{index +1}}
          </td>
          <td class="border-t">
            {{proposal.member}}
          </td>
          <td class="border-t">
            {{proposal.studio}}
          </td>
          <td class="border-t">
            <div v-if="proposal.specialization">
              {{ JSON.parse(proposal.specialization.name)[defaultlocale] }}
            </div>            
          </td>                       
          <td class="border-t ">
            <div v-if="proposal.country">
              {{ JSON.parse(proposal.country.name)[defaultlocale] }}
            </div>
          </td>
       
          <td class="border-t ">
            <div v-if="proposal.festival">
              {{ JSON.parse(proposal.festival.name)[defaultlocale] }}
            </div>
          </td>
          <td class="border-t">
            {{proposal.date}}
          </td>            
          <td class="border-t">
            <span v-if="proposal.status === 1">
              Новая
            </span>
            <span v-else-if="proposal.status === 2">
              Ожидаем оплату
            </span>
            <span v-else-if="proposal.status === 3">
              Оплачена
            </span>
            <span v-else-if="proposal.status === 4">
              Отменена
            </span>            
            <span v-else></span>            
          </td>          
          <td class="border-t">
            {{proposal.place_number}}
          </td>            
          <td class="flex pt-3 justify-end border-t">
            <inertia-link class="px-2" :href="route('proposals.edit', proposal.id)" tabindex="-1">
              <icon name="edit" class="block w-6 h-6 fill-green-600" />
            </inertia-link>
            <button
              class="px-2"
              @click.prevent ="showModal(proposal.id)">
                  <icon name="trash" class="block w-6 h-6 fill-red-600" />
            </button>
            <inertia-link class="px-2" :href="route('members.createfromproposal', proposal)" tabindex="-1" v-if="proposal.status === 3">
              <icon name="pen-tool" class="block w-6 h-6 fill-indigo-400" />
            </inertia-link>            
          </td>          
        </tr>
        <tr v-if="proposals.data.length === 0">
          <td class="border-t px-6 py-4" colspan="8">Нет записей</td>
        </tr>
      </table>
    </div>
    <pagination :links="proposals.links" />
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
import SearchFilter from '@/Shared/SearchFilter'
export default {
  metaInfo: { title: 'Заявки на участие' },
  layout: Layout,
  components: {
    Icon,
    Pagination,
    ModalConfirm,
    SearchFilter
  },
  props: {
    proposals: Object,
    filters: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        status: this.filters.status_id,
      },      
      open: false,
      record_id: '',
    }
  },
  watch: {
    form: {
      handler: throttle(function() {
        let query = pickBy(this.form)
        this.$inertia.replace(this.route('proposals', Object.keys(query).length ? query : { remember: 'forget' }))
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
        this.$inertia.delete(this.route('proposals.destroy', this.record_id))
    },    
  },
}
</script>
