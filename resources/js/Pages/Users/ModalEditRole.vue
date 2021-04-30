<template>
  <jet-dialog-modal :show="show" @close="close" maxWidth="sm">
    <template #title> Editar Rol </template>
    <template #content>
      <select
        name="role"
        id="role"
        v-model="selectedRole"
        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
      >
        <option
          v-for="(item, index) in roles"
          :key="index"
          :value="item"
          :selected="item.name === SelectedUser.role.name"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"
            />
          </svg>
          {{ item.name }}
        </option>
      </select>
    </template>
    <template #footer>
      <button @click="close" class="mr-2">Cancelar</button>
      <jet-button @click="saveChanges">Guardar</jet-button>
    </template>
  </jet-dialog-modal>
</template>
<script>
import JetDialogModal from "@/Jetstream/DialogModal";
import JetButton from "@/Jetstream/Button";

export default {
  name: "users.modal-edit-role",
  emits: ["close"],
  components: {
    JetDialogModal,
    JetButton,
  },

  props: {
    show: {
      default: false,
    },
  },

  data() {
    return {
      roles: null,
      selectedRole: null,
    };
  },

  mounted() {
    axios
      .get("/role")
      .then((response) => {
        this.roles = response.data
      })
      .catch((error) => {
        this.$swal({
          icon: "error",
          title: "Lo sentimos",
          text: "Ha ocurrido un error al pedir la lista de roles"
        })
      });
  },

  computed: {
    SelectedUser() {
      this.selectedRole = this.$store.getters.selectedUser.role
      return this.$store.getters.selectedUser
    },
  },

  methods: {
    close() {
      this.$emit("close")
    },
    saveChanges() {
      const param ={
        role_id:this.selectedRole.id
      }
      axios
        .put(`update_role_to_user/${this.SelectedUser.id}`,param)
        .then((response) => {
          if(!!response.data.error){
            this.$swal({
              icon: "error",
              title: "Advertencia",
              text: response.data.advertencia,
            })
          }else{
            this.$store.commit('modifySelectedUser',response.data.user)
            this.$swal(
              "Rol Cambiado!",
              "Se ha cambiado el rol con EXITO!",
              "success"
            )
          }
          this.close()
        })
        .catch((error) => {
          this.$swal({
            icon: "error",
            title: "Upps",
            text: "Lo sentimos ha ocurrido un error al cambiar el rol del usuario."
          })
        });
    },
    
  },
};
</script>