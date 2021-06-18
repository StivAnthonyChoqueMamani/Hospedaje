<template>
  <jet-dialog-modal :show="show" @close="closeModal" :max-width="'lg'">
    <template #title>
      Creating a new room
    </template>
    <template #content>
      <jet-validation-errors class="mb-4" />
      <form @submit.prevent="submit">
        <div class="grid grid-cols-6 gap-6">
          <div class="col-span-full sm:col-span-3">
            <jet-label for="nro" value="Número" />
            <jet-input ref="nro" id="nro" type="number" class="mt-1 block" v-model="form.nro" required autofocus="true" />
          </div>
          <div class="col-span-full sm:col-span-3">
            <jet-label for="nro_beds" value="Número de camas" />
            <jet-input id="nro_beds" type="number" class="mt-1 block" v-model="form.nro_beds" required />
          </div>
          <div class="col-span-full sm:col-span-3">
            <jet-label for="size_beds" value="Tamaño de camas"/>
            <select v-model="form.size_beds" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option v-for="(item, index) in options_size_beds" :key="index">{{item}}</option>
            </select>
          </div>
          <div class="col-span-full sm:col-span-3">
            <jet-label for="floor" value="Piso" />
            <jet-input id="floor" type="text" class="mt-1 block " v-model="form.floor" required />
          </div>
          <div class="col-span-6">
            <label class="flex items-center">
              <jet-checkbox name="is_bath" v-model:checked="form.is_bath" />
              <span class="ml-2 text-sm text-gray-600">Tiene baño?</span>
            </label>
          </div>
          <div class="col-span-6 ">
            <jet-label for="price" value="Precio" />
            <jet-input id="price" type="number" class="mt-1 block " v-model="form.price" />
          </div>
        </div>
      </form>
    </template>
    <template #footer>
      <jet-secondary-button @click="closeModal">
        Cancelar
      </jet-secondary-button>
      <jet-button @click="submit" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Log in
      </jet-button>
    </template>
  </jet-dialog-modal>
  
</template>
<script>
import JetDialogModal from '@/Jetstream/DialogModal'
import JetButton from '@/Jetstream/Button'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetLabel from '@/Jetstream/Label'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from '@/Jetstream/Checkbox'
import JetValidationErrors from '@/Jetstream/ValidationErrors'

export default {
  name: 'ModalCreateBedroom',

  components:{
    JetDialogModal,
    JetLabel,
    JetButton,
    JetSecondaryButton,
    JetInput,
    JetCheckbox,
    JetValidationErrors,
  },

  props:{
    show:{
      default: false,
    },
    status: String,
    options_size_beds:{
      default:null,
    },
    last_page_url:{
      default:null,
    },
  },

  data(){
    return {
      form: this.$inertia.form({
        nro: '',
        nro_beds: '',
        size_beds: 'undefined',
        floor: '',
        is_bath: false,
        price: '',
      }),
      options:null,
    }
  },

  methods:{
    submit() {
      this.form
        .post(this.route('store.bedroom'),{
          onSuccess: () =>{ 
            this.closeModal()
            this.$swal({
              icon: "success",
              title: "Operción Exitosos!",
              text: "La habitación ha sido agregado correctamente."
            })
          },
          onFinish: () => this.form.reset(),
        })
    },

    closeModal() {
      this.$emit('close')
      this.form.reset()
    },
    
  },
  
}
</script>