<template>
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Aprobación Teletrabajo</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i>Aprobación Teletrabajo




          </div>
          <div class="card-body">

            <table class="table table-bordered table-striped table-sm">

              <thead>
                <tr>

                  <th>Tipo de trabajo </th>
                  <th>Nombre De Empleado</th>
                  <th>Fecha inicio </th>
                  <th>Fecha final</th>
                  <th>Dias</th>
                  <th>Justificacion  </th>
                    <th>Estado </th>
                      <th>Aprobacion </th>
                </tr>
              </thead>
              <tbody>


                <tr v-for="applications in arrayApplications" :key="applications.id">

                  <td v-text="applications.typeJob"></td>
                  <td v-text="applications.employee"></td>
                   <td v-text="applications.startDate" ></td>
                 <td v-text="applications.endDate" ></td>
                    <td v-text="applications.day" ></td>
                       <td v-text="applications.observation" ></td>
                  <td>
                    <div v-if="applications.status ==1">


                      <span class="badge badge-success">Abrobado</span>
                    </div>
                    <div v-if="applications.status ==0">
                      <span class="badge badge-danger">Pendiente</span>
                    </div>


                  </td>

                   <td>

                    <template v-if="applications.status==1">
                      <button
                        type="button"
                        class="btn btn-danger btn-sm"
                        @click="disapproveApplications(applications.id)"
                      >
                        <i class="icon-trash"></i>
                      </button>
                    </template>

                     <template v-else>
                      <button
                        type="button"
                        class="btn btn-success"
                        @click="approveApplications(applications.id)"
                      >
                        <i class="icon-trash"></i>
                      </button>
                    </template>

                  </td>
                </tr>
              </tbody>
            </table>
            <nav>
              <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, filtro)"
                  >Ant</a>
                </li>
                <li
                  class="page-item"
                  v-for="page in pagesNumber"
                  :key="page"
                  :class="[page == isActived ? 'active' : '']"
                >
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(page, buscar, filtro)"
                    v-text="page"
                  ></a>
                </li>
                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, filtro)"
                  >Sig</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>

      </div>


      <vue-window-modal
        :active="mostrarMR"
        width="400px"
        height="auto"
        :title="tituloVentana"
        v-on:clickClose="mostrarMR=false"
      >
        <div class="container">
          <div class="row">
            <div class="col">
              <form action method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="form-group row">
                  <label class="col-md-3 form-control-label">Tipo De Teletrabajo</label>
                  <div class="col-md-9">
                   <v-select

                      :options="telecoArray"
                      label="name"
                      v-model="typeJob"
                      :reduce="telecommuting_id => telecommuting_id.name"
                    ></v-select>
                  </div>
                </div>





                 <div class="form-group row">
                  <label class="col-md-3 form-control-label"> usuario</label>
                  <div class="col-md-9">
                    <v-select

                      :options="usersArray"
                      label="name"
                      v-model="employee"
                      :reduce="users_id => users_id.name"
                    ></v-select>

                  </div>
                </div>




                 <div class="form-group row">
                  <label class="col-md-3 form-control-label">dias</label>
                  <div class="col-md-9">
              <v-select
              :options="rankDay"
               v-model="day"
             ></v-select>
                  </div>
                </div>



  <div class="form-group row">
                  <label class="col-md-3 form-control-label">Dia de Inicio</label>
                  <div class="col-md-9">

             <input type="date" v-model="startDate" class="form-control"  :min="dateNow" />
                  </div>
                </div>

     <div class="form-group row">
                  <label class="col-md-3 form-control-label">Dia de Finalizacion</label>
                  <div class="col-md-9">

             <input type="date" v-model="endDate" class="form-control"  :min="dateNow" />
                  </div>
                </div>

    <div class="form-group row">
                  <label class="col-md-3 form-control-label">Justificacion o Observacion</label>
                  <div class="col-md-9">

             <input type="text" v-model="observation" class="form-control" placeholder="Observacion" />
                  </div>
                </div>








              </form>
            </div>
          </div>
          <div class="row">
            <div class="col text-right">
              <button
                type="button"
                v-if="accion===0"
                class="btn "
                  style="background:#d3753e; color:white; border:1px solid #d3753e;"
                @click="registerApplication"
              >Guardar</button>
              <button
                type="button"
                v-if="accion===1"
                class="btn "
                  style="background:#d3753e; color:white; border:1px solid #d3753e;"
                @click="updateApplication"
              >Actualizar</button>
            </div>
          </div>
        </div>
      </vue-window-modal>





    </div>
  </main>
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
          this.tituloVentana = "Nueva Persona ";
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
            title: "Usuario agregada con exito!",
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
            title: "Usuario   actualizada con exito!",
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

    approveApplications(id) {
      Swal.fire({
        title: "¿Esta seguro de Aprobar  este usuario?",
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
            .post("/applications/approve", {
              id: id,
            })
            .then(function (response) {
              me.listApplications();
              Swal.fire({
                title: "Aprobado!",
                text: "El registro ha sido aprobado con éxito.",
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
        disapproveApplications(id) {
      Swal.fire({
        title: "¿Esta seguro de desaprobar  este Usuario?",
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
            .post("/applications/disapprove", {
              id: id,
            })
            .then(function (response) {
              me.listApplications();
              Swal.fire({
                title: "Desaprobado!",
                text: "El registro ha sido desaprobado  con éxito.",
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
