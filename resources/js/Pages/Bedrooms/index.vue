<template>
  <app-layout>
    <template #header>
      <div class="flex items-center justify-between h-15">        
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Bedrooms
        </h2>
        <button @click="create" class="relative flex items-center m-1 px-4 py-1 text-white bg-green-600 font-semibold rounded-lg border border-green-200 hover:bg-green-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          Crear
        </button>
      </div>
    </template>

    <div class="py-8">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                  <div class="flex m-2">
                    <span class="inline-flex flex-none items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-100 text-gray-500 text-sm">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                      </svg>
                    </span>
                    <input v-model="search" @keyup.enter="consult()" type="text" class="flex-grow focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none sm:text-sm border-gray-300" placeholder="Buscar">
                    <select v-model="selected" class="flex-none rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                      <option v-for="option in options" :key="option" :value="option.value">
                        {{option.text}}                  
                      </option>
                    </select>
                  </div>
                  <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg m-2">
                    <table class="min-w-full divide-y divide-gray-200" >
                      <thead class="bg-gray-50">
                        <tr>
                          <th scope="col" class="px-6 py-3 text-center text-xs font-mediun text-gray-500 uppercase tracking-wider">Numero</th>
                          <th scope="col" class="px-6 py-3 text-center text-xs font-mediun text-gray-500 uppercase tracking-wider">Numero de Camas</th>
                          <th scope="col" class="px-6 py-3 text-center text-xs font-mediun text-gray-500 uppercase tracking-wider">Tamaño de Camas</th>
                          <th scope="col" class="px-6 py-3 text-center text-xs font-mediun text-gray-500 uppercase tracking-wider">Piso</th>
                          <th scope="col" class="px-6 py-3 text-center text-xs font-mediun text-gray-500 uppercase tracking-wider">Tiene Baño?</th>
                          <th scope="col" class="px-6 py-3 text-center text-xs font-mediun text-gray-500 uppercase tracking-wider">Precio</th>
                          <th scope="col" class="px-6 py-3 text-center text-xs font-mediun text-gray-500 uppercase tracking-wider">Accion</th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="(item, index) in ListBedrooms.data" :key="index">
                          <td class="px-6 py-4 whitespace-nowrap text-center "> {{ item.nro }} </td>
                          <td class="px-6 py-4 whitespace-nowrap text-center "> {{ item.nro_beds }} </td>
                          <td class="px-6 py-4 whitespace-nowrap text-center "> {{ item.size_beds }} </td>
                          <td class="px-6 py-4 whitespace-nowrap text-center "> {{ item.floor }} </td>
                          <td class="px-6 py-4 whitespace-nowrap text-center "> {{ item.is_bath }} </td>
                          <td class="px-6 py-4 whitespace-nowrap text-center "> {{ item.price }} </td>
                          <td class="px-6 py-4 whitespace-nowrap text-center">
                            <button class="bg-gray-500 hover:bg-gray-700 py-1 px-1 text-white rounded" @click="edit_bedroom(item)">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                              </svg>
                            </button>
                            <button class="bg-blue-500 hover:bg-blue-700 py-1 px-1 m-1 text-white rounded-lg" @click="view_bedroom(index,item,$event)">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                              </svg>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <my-paginate
                      :current_page="bedrooms.current_page"
                      :first_page_url="bedrooms.first_page_url"
                      :from="bedrooms.from"
                      :last_page="bedrooms.last_page"
                      :last_page_url="bedrooms.last_page_url"
                      :next_page_url="bedrooms.next_page_url"
                      :path="bedrooms.path"
                      :per_page="bedrooms.per_page"
                      :prev_page_url="bedrooms.prev_page_url"
                      :to="bedrooms.to"
                      :total="bedrooms.total"
                      :links="bedrooms.links"
                    ></my-paginate>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <modal-create-bedroom :show="showModalCreate" @close="showModalCreate=false" :options_size_beds="enum_size_beds" :last_page_url="bedrooms.last_page_url" />
    <modal-view-bedroom :show="showModalView" @close="showModalView=false" :bedroom="bedroom_view" />
    <modal-edit-bedroom :show="showModalEdit" @close="showModalEdit=false" :bedroom="bedroom_edit" :bedroom_static="bedroom_static" :options_size_beds="enum_size_beds"/>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout"
import MyPaginate from "@/MyComponents/Paginate"
import { Inertia } from "@inertiajs/inertia"
import ModalCreateBedroom from '@/Pages/Bedrooms/ModalCreate'
import ModalViewBedroom from '@/Pages/Bedrooms/ModalView'
import ModalEditBedroom from '@/Pages/Bedrooms/ModalEdit'
export default {
  name: "bedrooms.index",
  inject: ['store'],
  props: {
    bedrooms: {
      type: Object,
      required: true,
    },
    enum_size_beds: {
      type: Array,
      default:null
    },
  },

  components: {
    AppLayout,
    MyPaginate,
    ModalCreateBedroom,
    ModalViewBedroom,
    ModalEditBedroom,
  },

  mounted() {
    this.store.commit('setBedrooms', this.bedrooms)
  },

  computed: {
    ListBedrooms(){
      return this.$store.getters.bedroomsAll
    }
  },

  data() {
    return {
      selected: 'nro',
      options:[
        { text: 'Número',           value: 'nro'},
        { text: 'Número de camas',  value: 'nro_beds'},
        { text: 'Tamaño de camas',  value: 'size_beds'},
        { text: 'Piso',             value: 'floor'},
        { text: 'Precio',           value: 'price'},
      ],
      search: null,
      showModalCreate:false,
      showModalView: false,
      bedroom_view: null,
      showModalEdit: false,
      bedroom_edit: {
        nro:'',
        nro_beds:'',
        size_beds:'',
        is_bath:'',
        floor:'',
        price:'',
      },
      bedroom_static: null,
    }
  },

  methods: {
    consult(){
      const param ={
        search: encodeURI(this.search),
        column: this.selected,
      }
      if(this.search==null){
        param.search='na'
      }
      console.log(param)
      // Inertia.get(`bedrooms/${param.search}/${param.column}`,{
      Inertia.get(this.route('search.bedroom',[param.search,param.column]),{
        onSuccess:(page)=>{
          console.log(page)
        },
        onError:(error)=>{
          console.log(error)
        }
      })
    },
    create() {
      this.showModalCreate = true
    },
    view_bedroom(index,data,event) {
      this.bedroom_view = data
      this.showModalView = true
    },
    edit_bedroom(data){
      this.bedroom_edit = JSON.parse(JSON.stringify(data))
      this.bedroom_static = JSON.parse(JSON.stringify(data))
      this.showModalEdit = true      
    }
  },
};
</script>