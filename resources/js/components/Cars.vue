<template>
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Autos</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> Autos

            <button
              type="button"
              class="btn btn-secondary float-right ml-1 boton"

              @click="abrirModal2(0)"

            >
              <i class="icon-plus"></i>&nbsp;Buscar por placa
            </button>
            <button
              type="button"
              class="btn btn-secondary float-right ml-1 boton"

              @click="abrirModal3(0)"
            >
              <i class="icon-plus"></i>&nbsp;Buscar por cedula
            </button>

              <button
              type="button"
              class="btn btn-secondary float-right ml-1 boton"

              @click="abrirModal4(0)"
            >
              <i class="icon-plus"></i>&nbsp;Buscar por Nombre propietario
            </button>
            <button
              type="button"
              class="btn btn-secondary float-right ml-1 boton"

              @click="abrirModal(0)"
            >
              <i class="icon-plus"></i>&nbsp;Nuevo
            </button>

             <button
              type="button"
              class="btn btn-secondary float-right ml-1 boton"

              @click="abrirModal5(0)"
            >
              <i class="icon-plus"></i>&nbsp;Listar Marca
            </button>


          </div>
          <div class="card-body">

            <table class="table table-bordered table-striped table-sm">

              <thead>
                <tr>

                  <th>PLACA </th>
                  <th>MARCA </th>
                  <th>TIPO DE VEHICULO</th>
                    <th>PROPIETARIO</th>
                   
                      <th>Accion </th>
                      
                </tr>
              </thead>
              <tbody>


                <tr v-for="Cars in arrayCars" :key="Cars.id">

                  <td v-text="Cars.plate"></td>
                 
                  <td v-text="Cars.brand"></td>
                   <td v-text="Cars.kind" ></td>
                     <td v-text="Cars.nameOwner" ></td>
               
                 
                  


                   <td>
                    <button
                      type="button"
                      class="btn btn-warning btn-sm"
                      @click="abrirModal(1, Cars)"
                    >
                      <i class="icon-pencil"></i>
                    </button> &nbsp;
                    <template>
                      <button
                        type="button"
                        class="btn btn-danger btn-sm"
                        @click="deleteCars(Cars.id)"
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
                  <label class="col-md-3 form-control-label">Placa</label>
                  <div class="col-md-9">

             <input type="text" v-model="plate" class="form-control" placeholder="Nombre" />
                <div class="text-info" v-if="!$v.plate.required">Este campo es requerido</div>
                  </div>
                </div>



    <div class="form-group row">
                  <label class="col-md-3 form-control-label">Marca</label>
                  <div class="col-md-9">

             <input type="text" v-model="brand" class="form-control" placeholder="Marca" />
               <div class="text-info" v-if="!$v.brand.required">Este campo es requerido</div>
                  </div>
                </div>

   <div class="form-group row">
                  <label class="col-md-3 form-control-label">Tipo de vehiculo</label>
                  <div class="col-md-9">

             <input type="text" v-model="kind" class="form-control" placeholder="Tipo de vehiculo" />
                   <div class="text-info" v-if="!$v.kind.required">Este campo es requerido</div>
                  </div>
                </div>

<div class="form-group row">
                  <label class="col-md-3 form-control-label"> usuario</label>
                  <div class="col-md-9">
                    <v-select

                      :options="usersArray"
                      label="name"
                      v-model="users_id"
                      :reduce="users_id => users_id.id"
                    ></v-select>
                      <div class="text-info" v-if="!$v.users_id.required">Este campo es requerido</div>

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
                @click="updateCars"
              >Actualizar</button>
            </div>
          </div>
        </div>
      </vue-window-modal>
<vue-window-modal
        :active="mostrarMR2"
        width="400px"
        height="300px"
        :title="tituloVentana"
        v-on:clickClose="mostrarMR2=false"
      >
        <div class="container">
          <div class="row">
            <div class="col">
              <form action method="post" enctype="multipart/form-data" class="form-horizontal">






                <div class="form-group row">
                  <label class="col-md-3 form-control-label">Buscar Por La Placa</label>
                  <div class="col-md-9">
                    <input type="text" v-model="plateCars" class="form-control" placeholder="Placa" />
                  </div>
                </div>

              </form>
            </div>
          </div>
          <div class="row">
            <div class="col text-right">
              <button
                type="button"
                v-if="accion2===0"
                class="btn "
                  style="background:#d3753e; color:white; border:1px solid #d3753e;"
                @click="listOptions"
              >Buscar</button>

            </div>
          </div>
        </div>
      </vue-window-modal>

        <vue-window-modal
        :active="mostrarMR3"
          width="400px"
        height="300px"
        :title="tituloVentana"
        v-on:clickClose="mostrarMR3=false"
      >
        <div class="container">
          <div class="row">
            <div class="col">
              <form action method="post" enctype="multipart/form-data" class="form-horizontal">
               <div class="form-group row">
                  <label class="col-md-3 form-control-label">ID Del Propietario</label>
                  <div class="col-md-9">
                    <input type="text" v-model="idOwner" class="form-control" placeholder="id" />
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col text-right">
              <button
                type="button"
                v-if="accion3===0"
                class="btn "
                  style="background:#d3753e; color:white; border:1px solid #d3753e;"
                @click="listOptions"
              >Buscar</button>

            </div>
          </div>
        </div>
      </vue-window-modal>


        <vue-window-modal
        :active="mostrarMR4"
         width="400px"
        height="300px"
        :title="tituloVentana"
        v-on:clickClose="mostrarMR4=false"
      >
        <div class="container">
          <div class="row">
            <div class="col">
              <form action method="post" enctype="multipart/form-data" class="form-horizontal">
               <div class="form-group row">
                  <label class="col-md-3 form-control-label">Nombre </label>
                  <div class="col-md-9">
                    <input type="text" v-model="NameOwner" class="form-control" placeholder="Nombre" />
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col text-right">
              <button
                type="button"
                v-if="accion3===0"
                class="btn "
                  style="background:#d3753e; color:white; border:1px solid #d3753e;"
                @click="listOptions"
              >Buscar</button>

            </div>
          </div>
        </div>
      </vue-window-modal>
   <vue-window-modal
        :active="mostrarMR5"
         width="auto"
        height="auto"
        :title="tituloVentana"
        v-on:clickClose="mostrarMR5=false"
      >
        <div class="container">
          <div class="row">
            <div class="col">
              <form action method="post" enctype="multipart/form-data" class="form-horizontal">
             
            


                       <div class="card-body">

            <table class="table table-bordered table-striped table-sm">

              <thead>
                <tr>

                  <th>CANTIDAD </th>
                  <th>MARCA </th>
                
                 
                   
                     
                      
                </tr>
              </thead>
              <tbody>


                <tr v-for="brand in arrayBrand" :key="brand.id">

                  <td v-text="brand.count"></td>
                 
                  <td v-text="brand.brand"></td>
                   
                  
               
                 
                  


                

             
                </tr>
              </tbody>
            </table>
           
          </div>

              </form>
            </div>
          </div>
         
        </div>
      </vue-window-modal>



    </div>
  </main>
</template>

<script>
import Swal from "sweetalert2";
import { required, minLength, maxLength } from "vuelidate/lib/validators";
import "vue-select/dist/vue-select.css";
export default {
   validations: {
    plate: {
      required,
    },
    brand: {
      required,
    },
    kind: {
      required,
    },
    users_id: {
      required,
    },
   },
  data() {
    return {
     rankDay:[1,2,3,4,5],
     dateNow : new Date().toISOString().slice(0,10),
        Carstatus:"",
      mostrarMR: false,
      mostrarMR2:false,
      mostrarMR3:false,
      mostrarMR4:false,
       mostrarMR5:false,
      accion: 0,
      accion2:0,
      accion3:0,
      accion4:0,
      tituloVentana: "",
      arrayCars: [],
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
      filtro: "plate",
      buscar: "",
      telecoArray: [],
      teleco_id: "",
      users_id:null,
      users:"",
       usersArray: [],
       telecommuting:"",
       telecommuting_id:"",
         plate:"",
         CarsId:"",
        brand:"",
        kind:"",
        plateCars:"",
        idOwner:null,
       NameOwner:"",
       arrayBrand:[]
       


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
          this.tituloVentana = "Nuevo Autos ";
        this.CarsId="",
        this.brand="",
        this.kind="",
        this.users_id=null,
         this.plate="";
          this.mostrarMR = true;
          this.accion = 0;
          break;
        }
        case 1: {
          this.tituloVentana = "Actualizar ";
    
        this.CarsId=data["CarsId"];
        this.brand=data["brand"];
        this.kind=data["kind"];
     this.users_id=null,
        this.plate=data["plate"];
          this.id = data["id"];
          this.mostrarMR = true;
          this.accion = 1;
          break;
        }
      }
    },
    abrirModal2(accion2) {
      switch (accion2) {
        case 0: {
          this.tituloVentana = "Buscar por Placa";
          this.plateCars = "";
           this.idOwner = "";
            this.NameOwner = "";
            this.mostrarMR2= true;
             this.accion2 = 0;
          break;
        }
      }
    },
     abrirModal3(accion3) {
      switch (accion3) {
        case 0: {
          this.tituloVentana = "Buscar por Cedula";
         this.plateCars = "";
           this.idOwner = "";
            this.NameOwner = "";
            this.mostrarMR3= true;
            this.petStatus="";
             this.accion3 = 0;
          break;
        }
      }
    },
      abrirModal4(accion3) {
      switch (accion3) {
        case 0: {
          this.tituloVentana = "Buscar por Nombre Del Usuario";
          this.plateCars = "";
           this.idOwner = "";
            this.NameOwner = "";
            this.mostrarMR4= true;
            this.petStatus="";
             this.accion4 = 0;
          break;
        }
      }
    },
  abrirModal5(accion3) {
      switch (accion3) {
        case 0: {
          this.tituloVentana = "Listado Por Marca";
          this.plateCars = "";
           this.idOwner = "";
            this.NameOwner = "";
            this.mostrarMR5= true;
            this.petStatus="";
             this.accion4 = 0;
          break;
        }
      }
    },


    listCars() {
      let me = this;
      let url ="/Cars";
      axios
        .get(url, {

        })
        .then(function (response) {

          me.arrayCars = response.data;
          console.log( me.arrayCars)

          console.log( response.data)
        })
        .catch(function (error) {
          console.log(error);
        });
          this.mostrarMR2=false;
      this.mostrarMR3=false;
    },
       listOptions() {
      let me = this;
      me.arrayCars=[];
      let url ="/listOption";
      axios
        .post(url, {
         
          plateCars: this.plateCars,
          idOwner: this.idOwner,
            NameOwner:this.NameOwner,
        })
        .then(function (response) {
        Swal.fire({
            position: "center",
            type: "success",
            title: "Busqueda realizada  con exito!",
            showConfirmButton: false,
            timer: 1500,
          });
          me.arrayCars = response.data;
          console.log( me.usersArray)
          console.log( response.data)
        })
        .catch(function (error) {
          console.log(error);
        });
          this.mostrarMR2=false;
      this.mostrarMR3=false;
       this.mostrarMR4=false;
    },
  
   listBrand() {
      let me = this;
      me.arrayCars=[];
      let url ="/listBrand";
      axios
        .get(url, {
         
        
        })
        .then(function (response) {
       
          me.arrayBrand = response.data;
       
        })
        .catch(function (error) {
          console.log(error);
        });
          this.mostrarMR2=false;
      this.mostrarMR3=false;
       this.mostrarMR4=false;
    },
  
 listOwners() {
      let me = this;
      let url = "/Owners";
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
      me.listarCars(page, buscar, filtro);
    },
    registerApplication() {
      let me = this;

     //   this.submitted = true;
      this.$v.$touch();
     
      if (this.$v.$invalid) {
        return false;
      }
      axios
        .post("/Cars", {

        users_id:this.users_id,
         id:this.id,
        brand:this.brand,
        kind:this.kind,
        plate:this.plate,


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
       me.listCars();
       me.listBrand();
        })
        .catch(function (error) {
          Swal.fire({
            position: "center",
            type: "warning",
            title: "Error (" + error.status + "): " + error,
          });
        });
    },
    updateCars() {
      let me = this;
      axios
        .post("/Cars/update", {


          id: this.id,
      users_id:this.users_id,
       
        brand:this.brand,
        kind:this.kind,
        plate:this.plate,
        })
        .then(function (response) {
          Swal.fire({
            position: "center",
            type: "success",
            title: "Usuario actualizada con exito!",
            showConfirmButton: false,
            timer: 1500,
          });
          me.mostrarMR = false;
         me.listCars();
        })
        .catch(function (error) {
          Swal.fire({
            position: "center",
            type: "warning",
            title: "Error (" + error.status + "): " + error,
          });
        });
    },
    deleteCars(id) {
      Swal.fire({
        title: "¿Esta seguro de eliminar este Usuario?",
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
            .post("/Cars/dalete", {
              id: id,
            })
            .then(function (response) {
              me.listCars();
              Swal.fire({
                title: "Eliminado!",
                text: "El registro ha sido eliminado con éxito.",
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
  this.listCars();

this.listOwners();
this.listBrand();
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
