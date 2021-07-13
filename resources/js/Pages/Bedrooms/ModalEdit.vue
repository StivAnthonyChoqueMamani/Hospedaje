<template>
  <jet-dialog-modal :show="show" @close="closeModal" :max-width="'lg'">
    <template #tittle>
      EDITANDO LA HABITACION NUMERO {{bedroom.nro}}
    </template>
    
    <template #content>
      <form @submit.prevent="submit">
        <div class="grid grid-cols-6 gap-6">
          <div class="col-span-full sm:col-span-3">
            <jet-label for="nro" value="Número" />
            <jet-input ref="nro" id="nro" type="number" class="mt-1 block" v-model="bedroom.nro" required />
          </div>
          <div class="col-span-full sm:col-span-3">
            <jet-label for="nro_beds" value="Número de camas" />
            <jet-input id="nro_beds" type="number" class="mt-1 block" v-model="bedroom.nro_beds" required />
          </div>
          <div class="col-span-full sm:col-span-3">
            <jet-label for="size_beds" value="Tamaño de camas"/>
            <select v-model="bedroom.size_beds" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option v-for="(item, index) in options_size_beds" :key="index">{{item}}</option>
            </select>
          </div>
          <div class="col-span-full sm:col-span-3">
            <jet-label for="floor" value="Piso" />
            <jet-input id="floor" type="text" class="mt-1 block " v-model="bedroom.floor" required />
          </div>
          <div class="col-span-6">
            <label class="flex items-center" @click="bedroom.is_bath = !bedroom.is_bath">
              <!-- <input type="checkbox" id="checkbox" v-model="bedroom.is_bath" /> -->
              <!-- <jet-checkbox name="is_bath" v-model:checked="bedroom.is_bath" /> -->
              <div v-if="bedroom.is_bath">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div v-else>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <span class="ml-2 text-sm text-gray-600">Tiene baño?</span>
            </label>
          </div>
          <div class="col-span-6 ">
            <jet-label for="price" value="Precio" />
            <jet-input id="price" type="number" class="mt-1 block " v-model="bedroom.price" />
          </div>
        </div>
      </form>
    </template>

    <template #footer>
      <jet-secondary-button @click="closeModal">Cancelar</jet-secondary-button>
      <jet-button 
        v-if="change_nro||change_nrobeds||change_sizebeds||change_isbath||change_floor||change_price" 
        @click="submit" 
      >Guardar Cambio</jet-button>
    </template>
  </jet-dialog-modal>
</template>
<script>
import JetDialogModal from '@/Jetstream/DialogModal'
import JetCheckbox from '@/Jetstream/Checkbox'
import JetLabel from '@/Jetstream/Label'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetInput from '@/Jetstream/Input'
import JetButton from '@/Jetstream/Button'
import { Inertia } from '@inertiajs/inertia'
export default {
  name: 'ModalEditBedroom',
  
  emits: ['close','update'],

  components: {
    JetDialogModal,
    JetLabel,
    JetSecondaryButton,
    JetButton,
    JetInput,
    JetCheckbox,
  },

  props: {
    show:{
      default: false,
    },
    bedroom: {
      default: true,
    },
    bedroom_static: {
      default: false,
    },
    options_size_beds:{
      default: null,
    },
  },

  data(){
    return {
      form: this.$inertia.form({
        id: '',
        nro: '',
        nro_beds: '',
        size_beds: '',
        floor: '',
        is_bath: '',
        price: '',
        created_at: '',
        updated_at: '',
      }),
    }
  },

  methods: {
    closeModal() {
      this.$emit('close')
      this.form.reset()
    },
    submit(){
      this.form.id = this.bedroom.id
      this.form.nro = this.bedroom.nro
      this.form.nro_beds = this.bedroom.nro_beds
      this.form.size_beds = this.bedroom.size_beds
      this.form.floor = this.bedroom.floor
      this.form.is_bath = this.bedroom.is_bath
      this.form.price = this.bedroom.price
      this.form.created_at = this.bedroom.created_at
      this.form.updated_at = this.bedroom.updated_at
      
      this.form.put(this.route('update.bedroom',this.bedroom.id),{
        onSuccess:response=>{
          console.log(response)
          this.$swal({
            icon: "success",
            title: "Operación Exitoso!",
            text: "La habitación ha sido modificado con exito."
          })
          this.closeModal()
          this.bedroom_static.nro_beds = this.bedroom.nro_beds
          this.bedroom_static.size_beds = this.bedroom.size_beds
          this.bedroom_static.floor = this.bedroom.floor
          this.bedroom_static.is_bath = this.bedroom.is_bath
          this.bedroom_static.price = this.bedroom.price
        },
        onError: errors => {
          console.log(errors)
          this.form.reset ()
        },
      })
    },
  },

  computed: {
    change_nro(){
      if(this.bedroom != null){
        if(this.bedroom.nro != this.bedroom_static.nro){
          return true
        }else{
          return false
        }
      }else{
        return null
      }
    },

    change_nrobeds(){
      if(this.bedroom!=null){
        if(this.bedroom.nro_beds != this.bedroom_static.nro_beds){
          return true
        }else{
          return false
        }
      }else{
        return null
      }
    },

    change_sizebeds(){
      if(this.bedroom!=null){
        if(this.bedroom.size_beds != this.bedroom_static.size_beds){
          return true
        }else{
          return false
        }
      }else{
        return null
      }
    },

    change_isbath(){
      if(this.bedroom!=null){
        if(this.bedroom.is_bath != this.bedroom_static.is_bath){
          return true
        }else{
          return false
        }
      }else{
        return null
      }
    },

    change_floor(){
      if(this.bedroom!=null){
        if(this.bedroom.floor != this.bedroom_static.floor){
          return true
        }else{
          return false
        }
      }else{
        return null
      }
    },

    change_price(){
      if(this.bedroom!=null){
        if(this.bedroom.price != this.bedroom_static.price){
          return true
        }else{
          return false
        }
      }else{
        return null
      }
    },

    // check(){
    //   if(this.bedroom != null){
    //     if(this.bedroom.is_bath){
    //       this.bedroom.is_bath = true
    //       return true
    //     }else{
    //       this.bedroom.is_bath = false
    //       return false
    //     }
    //   }else{
    //     return null
    //   }
    // },
  },
}
</script>