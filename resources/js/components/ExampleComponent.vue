<template>
      <div>


        <div class="container mb-1" >

            <router-link class="btn btn-primary" :to="{ name: 'ingresar' }">ingresar </router-link>
               <router-link class="btn btn-primary" :to="{ name: 'approval' }">aprobar </router-link>
        </div>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";
import "vue-select/dist/vue-select.css";
export default {
  data() {
    return {
     rankDay:[1,2,3,4,5],
     dateNow : new Date().toISOString().slice(0,10),
        applicationstatus:"",
      mostrarMR: false,

      accion: 0,
        accion2: 0,
          accion3: 0,
      tituloVentana: "",
      arrayApplications: [],
      id: 0,

     status: "",
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 3,
      filtro: "name",
      buscar: "",
      telecoArray: [],
      teleco_id: "",
      users_id:"",
      users:"",
       usersArray: [],
       telecommuting:"",
       telecommuting_id:"",
       day:"",
         name:"",
         typeJob:"",
        employee:"",
        startDate:"",
        endDate:"",
        observation:"",


    };
  },
  computed: {



    isActived: function () {
      return this.pagination.current_page;
    },
    //Calcula los elementos de la paginación
    pagesNumber: function () {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },
  },
  methods: {
    abrirModal(accion, data = []) {
      switch (accion) {
        case 0: {
          this.tituloVentana = "Nuevo Persona ";
        this.day="",
        this.typeJob="",
        this.employee="",
        this.startDate="",
       this.endDate="",
        this.observation="",
          this.mostrarMR = true;
          this.accion = 0;
          break;
        }
        case 1: {
          this.tituloVentana = "Actualizar ";
        this.day=data["day"];
        this.typeJob=data["typeJob"];
        this.employee=data["employee"];
        this.startDate=data["startDate"];
       this.endDate=data["endDate"];
        this.observation=data["observation"];
          this.id = data["id"];
          this.mostrarMR = true;
          this.accion = 1;
          break;
        }
      }
    },



    listApplications() {
      let me = this;
      let url ="/applications";
      axios
        .get(url, {

        })
        .then(function (response) {
        Swal.fire({
            position: "center",
            type: "success",
            title: "Busqueda realizada  con exito!",
            showConfirmButton: false,
            timer: 1500,
          });
          me.arrayApplications = response.data;
          console.log( me.arrayApplications)

          console.log( response.data)
        })
        .catch(function (error) {
          console.log(error);
        });
          this.mostrarMR2=false;
      this.mostrarMR3=false;
    },
    listTelecommuting() {
      let me = this;
      let url = "/telecommuting";

      axios
        .get(url)
        .then((res) => {
          me.telecoArray = res.data;

        })
        .catch(function (error) {
          console.log(error);
        });
         this.mostrarMR2= false;
    },

    listUsers() {
      let me = this;
      let url = "/users";

      axios
        .get(url)
        .then((res) => {
          me.usersArray = res.data;
          console.log(res.data)
        })
        .catch(function (error) {
          console.log(error);
        });
         this.mostrarMR2= false;
    },
    cambiarPagina(page, buscar, filtro) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarapplicationss(page, buscar, filtro);
    },
    registerApplication() {
      let me = this;
      axios
        .post("/applications", {

         day:this.day,
         typeJob:this.typeJob,
        employee:this.employee,
        startDate:this.startDate,
        endDate:this.endDate,
        observation:this.observation,


        })
        .then(function (response) {
          Swal.fire({
            position: "center",
            type: "success",
            title: "Mascota agregada con exito!",
            showConfirmButton: false,
            timer: 1500,
          });
          me.mostrarMR = false;
       me.listApplications();
        })
        .catch(function (error) {
          Swal.fire({
            position: "center",
            type: "warning",
            title: "Error (" + error.status + "): " + error,
          });
        });
    },
    updateApplication() {
      let me = this;
      axios
        .post("/applications/update", {


          id: this.id,
         day:this.day,
         typeJob:this.typeJob,
        employee:this.employee,
        startDate:this.startDate,
        endDate:this.endDate,
        observation:this.observation,
        })
        .then(function (response) {
          Swal.fire({
            position: "center",
            type: "success",
            title: "Mascota actualizada con exito!",
            showConfirmButton: false,
            timer: 1500,
          });
          me.mostrarMR = false;
          me.listApplications();
        })
        .catch(function (error) {
          Swal.fire({
            position: "center",
            type: "warning",
            title: "Error (" + error.status + "): " + error,
          });
        });
    },
    deleteapplications(id) {
      Swal.fire({
        title: "¿Esta seguro de eliminar esta mascota?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true,
      }).then((result) => {
        if (result.value) {
          let me = this;
          axios
            .post("/applications/dalete", {
              id: id,
            })
            .then(function (response) {
              me.listApplications();
              Swal.fire({
                title: "Desactivado!",
                text: "El registro ha sido desactivado con éxito.",
                type: "success",
                showConfirmButton: false,
                timer: 1500,
              });
            })
            .catch(function (error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === Swal.DismissReason.cancel
        ) {
        }
      });
    },

  },
  mounted() {
    this.listApplications();
 this.listTelecommuting();
      this.listUsers();


  },
};
</script>
<style>

form {
  margin-top: 15px;
}

.boton{
  background:#d3753e; color:white; border:1px solid #d3753e;

}

</style>
