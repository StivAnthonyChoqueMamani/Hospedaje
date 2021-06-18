<template>
  <jet-dialog-modal :show="show" @close="closeModal" :max-width="'lg'">
    <template #title>
      HABITACIÓN NÚMERO {{bedroom.nro}}
    </template>
    <template #content>
      <p>
      Cuenta con {{bedroom.nro_beds}} cama(s), 
      el tamaño de la(s) cama(s) son de {{bedroom.size_beds}},
      <strong v-if="!bedroom.is_bath">
        no
      </strong>
      cuenta con servicio de baño,
      la habitacion se encuentra en el piso {{bedroom.floor}}
      y el precio de la habitacion es de S/{{bedroom.price}} soles.
      </p> 
    </template>
    <template #footer>
      <jet-secondary-button @click="closeModal" >Continue</jet-secondary-button>
    </template>
  </jet-dialog-modal>  
</template>
<script>
import JetDialogModal from '@/Jetstream/DialogModal'
import JetLabel from '@/Jetstream/Label'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
export default {
  name:'ModalViewBedroom',
  
  components:{
    JetDialogModal,
    JetLabel,
    JetSecondaryButton,
  },

  props:{
    show:{
      default: false,
    },
    bedroom:{
      type:Object,
      default:null,
    },
  },

  methods: {
    closeModal() {
      this.$emit('close')
    },
  }

}
</script>