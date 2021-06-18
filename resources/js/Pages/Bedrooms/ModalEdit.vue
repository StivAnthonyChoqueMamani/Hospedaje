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
            <label class="flex items-center">
              <input type="checkbox" id="checkbox" v-model="bedroom.is_bath" />
              <!-- <jet-checkbox name="is_bath" v-model:checked="bedroom.is_bath" /> -->
              <span class="ml-2 text-sm text-gray-600">Tiene baño?</span>
            </label>
          </div>
          <div class="col-span-6 ">
            <jet-label for="price" value="Precio" />
            <jet-input id="price" type="number" class="mt-1 block " v-model="bedroom.price" />
          </div>
        </div>
      </form>
      {{bedroom.is_bath}}
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
export default {
  name: 'ModalEditBedroom',
  
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
        nro: this.bedroom.nro,
        nro_beds: this.bedroom.nro_beds,
        size_beds: this.bedroom.size_beds,
        floor: this.bedroom.floor,
        is_bath: this.bedroom.is_bath,
        price: this.bedroom.price,
      }),
    }
  },

  methods: {
    closeModal() {
      this.$emit('close')
      // this.form.reset()
    },
    submit(){
      this.form.put(this.route('update.bedroom',this.bedroom.id),{
        onSuccess:(response)=>{
          console.log(response.data)
          this.closeModal()
        }
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

    check(){
      if(this.bedroom != null){
        if(this.bedroom.is_bath){
          this.bedroom.is_bath = true
        }else{
          this.bedroom.is_bath = false
        }
      }else{
        return null
      }
    },
  },
}
</script>