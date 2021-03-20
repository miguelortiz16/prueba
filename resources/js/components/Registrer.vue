<template>
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Propietario</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> Propietario
             <button
              type="button"
              class="btn btn-secondary float-right ml-1 boton"

              @click="abrirModal2(0)"
            >
              <i class="icon-plus"></i>&nbsp;Nuevo Funcionaliad Requerida Parte 2
            </button>

            <button
              type="button"
              class="btn btn-secondary float-right ml-1 boton"

              @click="abrirModal(0)"
            >
              <i class="icon-plus"></i>&nbsp;Nuevo
            </button>


          </div>
          <div class="card-body">

            <table class="table table-bordered table-striped table-sm">

              <thead>
                <tr>

                  <th>NOMBRE </th>
                  <th>CEDULA</th>
                  <th>TELEFONO </th>
                  <th>DIRECCION</th>
                   
                      <th>Accion </th>
                      
                </tr>
              </thead>
              <tbody>


                <tr v-for="Owners in arrayOwners" :key="Owners.id">

                  <td v-text="Owners.name"></td>
                  <td v-text="Owners.id" ></td>
                  <td v-text="Owners.phone"></td>
                   <td v-text="Owners.address" ></td>
               
                 
                  


                   <td>
                    <button
                      type="button"
                      class="btn btn-warning btn-sm"
                      @click="abrirModal(1, Owners)"
                    >
                      <i class="icon-pencil"></i>
                    </button> &nbsp;
                    <template>
                      <button
                        type="button"
                        class="btn btn-danger btn-sm"
                        @click="deleteOwners(Owners.id)"
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
                  <label class="col-md-3 form-control-label">Nombre</label>
                  <div class="col-md-9">

             <input type="text" v-model="name" class="form-control" placeholder="Nombre" />
                   <div class="text-info" v-if="!$v.name.required">Este campo es requerido</div>
             
                  </div>
                </div>


<div v-if="accion == 0">


                 <div class="form-group row">
                  <label class="col-md-3 form-control-label">Cedula</label>
                  <div class="col-md-9">

             <input type="number" v-model="id" class="form-control" placeholder="Cedula" />
                <div class="text-info" v-if="!$v.id.required">Este campo es requerido</div>
                  </div>
                </div>
</div>
    <div class="form-group row">
                  <label class="col-md-3 form-control-label">Telefono</label>
                  <div class="col-md-9">

             <input type="number" v-model="phone" class="form-control" placeholder="Telefono" />
                  <div class="text-info" v-if="!$v.phone.required">Este campo es requerido</div>
                  </div>
                </div>

   <div class="form-group row">
                  <label class="col-md-3 form-control-label">Direccion</label>
                  <div class="col-md-9">

             <input type="text" v-model="address" class="form-control" placeholder="Direccion" />
                 <div class="text-info" v-if="!$v.address.required">Este campo es requerido</div>
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
                @click="updateOwners"
              >Actualizar</button>
            </div>
          </div>
        </div>
      </vue-window-modal>


       <vue-window-modal
        :active="mostrarMR2"
        width="400px"
        height="400px"
        :title="tituloVentana"
        v-on:clickClose="mostrarMR2=false"
      >
        <div class="container">
          <div class="row">
            <div class="col">
              <form action method="post" enctype="multipart/form-data" class="form-horizontal">
                
                

          {{Part2}}


    



    





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
import "vue-select/dist/vue-select.css";
import { required, minLength, maxLength } from "vuelidate/lib/validators";
export default {
   validations: {
    name: {
      required,
    },
    id: {
      required,
    },
    phone: {
      required,
    },
    address: {
      required,
    },
   },
  data() {
    return {
     rankDay:[1,2,3,4,5],
     dateNow : new Date().toISOString().slice(0,10),
        Ownerstatus:"",
      mostrarMR: false,
      mostrarMR2:false,
      accion: 0,
      tituloVentana: "",
      arrayOwners: [],
      id: null,

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
      
         name:"",
         ownerId:"",
        phone:"",
        address:"",
        Part2:null
       
       


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
          this.tituloVentana = "Nuevo Propietario ";
        this.ownerId="",
        this.phone="",
        this.address="",
       this.id=null;
       this.name="";
          this.mostrarMR = true;
          this.accion = 0;
          break;
        }
        case 1: {
          this.tituloVentana = "Actualizar ";
    
        this.ownerId=data["ownerId"];
        this.phone=data["phone"];
        this.address=data["address"];
     
        this.name=data["name"];
          this.id = data["id"];
          this.mostrarMR = true;
          this.accion = 1;
          break;
        }
      }
    },
  abrirModal2(accion, data = []) {
      switch (accion) {
        case 0: {
          this.tituloVentana = "Nuevo Funcioalidad Parte 2 ";
      
  
          this.mostrarMR2 = true;
          this.accion = 0;
          break;
        }
       
      }
    },



    listOwners() {
      let me = this;
      let url ="/Owners";
      axios
        .get(url, {

        })
        .then(function (response) {

          me.arrayOwners = response.data;
          console.log( me.arrayOwners)

          console.log( response.data)
        })
        .catch(function (error) {
          console.log(error);
        });
          this.mostrarMR2=false;
      this.mostrarMR3=false;
    },
  

   
    cambiarPagina(page, buscar, filtro) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarOwnerss(page, buscar, filtro);
    },

    part2(){

  


let arrayPart2 = [
    [ " 2018-12-01 " , " AM " , " ID123 " , 5000 ],
    [ " 2018-12-01 " , " AM " , " ID545 " , 7000 ],
    [ " 2018-12-01 " , " PM " , " ID545 " , 3000 ],
    [ " 2018-12-02 " , " AM " , " ID545 " , 7000 ]
];
let final = {};
let day = '';
let time = '';
arrayPart2.forEach(el => {
    day = el[0];
    time = el[1];
    if (typeof final[day] === 'undefined') { 
        final[day] = {};
    }
    if (typeof final[day][time] === 'undefined') { 
        final[day][time] = 0;
    }
    final[day][time] += el[3]; 
});
this.Part2=final;
console.log(final);



    },
    registerApplication() {
      let me = this;
       this.$v.$touch();
     
      if (this.$v.$invalid) {
        return false;
      }
      axios
        .post("/Owners", {

        
         id:this.id,
        phone:this.phone,
        address:this.address,
        name:this.name,


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
       me.listOwners();
        })
        .catch(function (error) {
          Swal.fire({
            position: "center",
            type: "warning",
            title: "Error (" + error.status + "): " + error,
          });
        });
    },
    updateOwners() {
      let me = this;
       this.$v.$touch();
     
      if (this.$v.$invalid) {
        return false;
      }
      axios
        .post("/Owners/update", {


          id: this.id,
         ownerId:this.ownerId,
        phone:this.phone,
        address:this.address,
        name:this.name,
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
         me.listOwners();
        })
        .catch(function (error) {
          Swal.fire({
            position: "center",
            type: "warning",
            title: "Error (" + error.status + "): " + error,
          });
        });
    },
    deleteOwners(id) {
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
            .post("/Owners/dalete", {
              id: id,
            })
            .then(function (response) {
              me.listOwners();
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
  this.listOwners();

this.part2();

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
