<template>
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Mascotas</li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> Mascotas
             <button
              type="button"
              class="btn btn-secondary float-right ml-1 boton"

              @click="abrirModal2(0)"
            >
              <i class="icon-plus"></i>&nbsp;Buscar por estado
            </button>
            <button
              type="button"
              class="btn btn-secondary float-right ml-1 boton"

              @click="abrirModal3(0)"
            >
              <i class="icon-plus"></i>&nbsp;Buscar por id
            </button>
            <button
              type="button"
              class="btn btn-secondary float-right ml-1 boton"

              @click="abrirModal(0)"
            >
              <i class="icon-plus"></i>&nbsp;Nueva
            </button>


          </div>
          <div class="card-body">

            <table v-if="idPet!='' || petStatus!=''" class="table table-bordered table-striped table-sm">

              <thead>
                <tr>

                  <th>NOMBRE</th>
                  <th>CATEGORIA</th>
                  <th>FOTO</th>
                  <th>ESTADO</th>
                  <th>Tags</th>
                  <th>ACCION</th>
                </tr>
              </thead>
              <tbody>


                <tr v-for="pets in arrayPets" :key="pets.id">

                  <td v-text="pets.name"></td>
                  <td v-text="pets.category.name"></td>
                   <td >
                       <div v-if="pets.photoUrls[0]!=''">
                           <img width="150" height="100" :src="pets.photoUrls[0]" alt="">
                       </div>
                    <div v-else-if="pets.photoUrls[0]===''">

                       </div>

                   </td>

                  <td>
                    <div v-if="pets.status =='available'">


                      <span class="badge badge-success">available</span>
                    </div>
                    <div v-if="pets.status =='pending'">
                      <span class="badge badge-danger">pending</span>
                    </div>

                     <div v-if="pets.status =='sold'">
                      <span class="badge badge-danger">sold</span>
                    </div>
                  </td>
                    <td v-text="pets.tags[0].name "></td>
                   <td>
                    <button
                      type="button"
                      class="btn btn-warning btn-sm"
                      @click="abrirModal(1, pets)"
                    >
                      <i class="icon-pencil"></i>
                    </button> &nbsp;
                    <template>
                      <button
                        type="button"
                        class="btn btn-danger btn-sm"
                        @click="deletePets(pets.id)"
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
        height="450px"
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
                  </div>
                </div>





                 <div class="form-group row">
                  <label class="col-md-3 form-control-label"> Categoria</label>
                  <div class="col-md-9">
                    <v-select

                      :options="value2"
                      label="name"
                      v-model="category"
                      :reduce="category_id => category_id.id"
                    ></v-select>

                  </div>
                </div>




                 <div class="form-group row">
                  <label class="col-md-3 form-control-label">Tags</label>
                  <div class="col-md-9">
                    <v-select

                      :options="tagsArray"
                      label="name"
                      v-model="tags"
                      :reduce="tags_id => tags_id.id"
                    ></v-select>

                  </div>
                </div>

                 <div class="form-group row">
                  <label class="col-md-3 form-control-label">Url de la foto</label>
                  <div class="col-md-9">
                    <input type="text" v-model="photoUrls" class="form-control" placeholder="foto" />
                  </div>
                </div>



                  <div class="form-group row">
                  <label class="col-md-3 form-control-label"> estado </label>
                  <div class="col-md-9">
                    <v-select

                     :options="options"
                      label="name"
                      v-model="status"

                    ></v-select>

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
                @click="registerPet"
              >Guardar</button>
              <button
                type="button"
                v-if="accion===1"
                class="btn "
                  style="background:#d3753e; color:white; border:1px solid #d3753e;"
                @click="updatePet"
              >Actualizar</button>
            </div>
          </div>
        </div>
      </vue-window-modal>


       <vue-window-modal
        :active="mostrarMR2"
        width="300px"
        height="200px"
        :title="tituloVentana"
        v-on:clickClose="mostrarMR2=false"
      >
        <div class="container">
          <div class="row">
            <div class="col">
              <form action method="post" enctype="multipart/form-data" class="form-horizontal">






                 <div class="form-group row">
                  <label class="col-md-3 form-control-label">Selecciona el estado </label>
                  <div class="col-md-9">
                    <v-select

                     :options="options"
                      label="name"
                      v-model="petStatus"

                    ></v-select>

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
                @click="listPet"
              >Buscar</button>

            </div>
          </div>
        </div>
      </vue-window-modal>

        <vue-window-modal
        :active="mostrarMR3"
        width="300px"
        height="200px"
        :title="tituloVentana"
        v-on:clickClose="mostrarMR3=false"
      >
        <div class="container">
          <div class="row">
            <div class="col">
              <form action method="post" enctype="multipart/form-data" class="form-horizontal">
               <div class="form-group row">
                  <label class="col-md-3 form-control-label">ID que quieres buscar</label>
                  <div class="col-md-9">
                    <input type="text" v-model="idPet" class="form-control" placeholder="id" />
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
                @click="listPet"
              >Buscar</button>

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

        idPet:"",
        options: ["available","pending","sold"],
        petStatus:"",
      mostrarMR: false,
      mostrarMR2: false,
      mostrarMR3:false,
      accion: 0,
        accion2: 0,
          accion3: 0,
      tituloVentana: "",
      arrayPets: [],
      id: 0,
    category: "",
    name: "",
    photoUrls: "",
    tags: "",
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
      value2: [],
      category_id: "",
       tagsArray: [],
      tags_id: "",
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
          this.tituloVentana = "Nueva Mascota";
          this.name = "";
            this.category="";

    this.photoUrls="";
    this.tags=  "";
     this.status= "";
          this.mostrarMR = true;
          this.accion = 0;
          break;
        }
        case 1: {
          this.tituloVentana = "Actualizar ";
          this.name = data["name"];
        this.category= data["category"];

    this.photoUrls=data["photoUrls"];
    this.tags=  data["tags"];
     this.status= data["status"];
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
          this.tituloVentana = "Buscar por Estado";
          this.idPet = 1;
            this.mostrarMR2= true;

             this.accion2 = 0;
          break;
        }

      }
    },

     abrirModal3(accion3) {
      switch (accion3) {
        case 0: {
          this.tituloVentana = "Buscar por Id";
          this.idPet = "";
            this.mostrarMR3= true;
            this.petStatus="";

             this.accion3 = 0;
          break;
        }

      }
    },
    listPet() {
      let me = this;
      let url ="/pet/findByStatus";
      axios
        .post(url, {
          petStatus: me.petStatus,
          idPet: me.idPet
        })
        .then(function (response) {
        Swal.fire({
            position: "center",
            type: "success",
            title: "Busqueda realizada  con exito!",
            showConfirmButton: false,
            timer: 1500,
          });
          me.arrayPets = response.data;
          console.log( me.arrayPets)

          console.log( response.data)
        })
        .catch(function (error) {
          console.log(error);
        });
          this.mostrarMR2=false;
      this.mostrarMR3=false;
    },
    listCategory() {
      let me = this;
      let url = "/category";

      axios
        .get(url)
        .then((res) => {
          me.value2 = res.data;

        })
        .catch(function (error) {
          console.log(error);
        });
         this.mostrarMR2= false;
    },

    listTags() {
      let me = this;
      let url = "/Tags";

      axios
        .get(url)
        .then((res) => {
          me.tagsArray = res.data;
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
      me.listarpetss(page, buscar, filtro);
    },
    registerPet() {
      let me = this;
      axios
        .post("/pet", {
          name: this.name,
          category : this.category,
           photoUrls: this.photoUrls,
           tags: this.tags,
           status: this.status,


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
       me.listPet();
        })
        .catch(function (error) {
          Swal.fire({
            position: "center",
            type: "warning",
            title: "Error (" + error.status + "): " + error,
          });
        });
    },
    updatePet() {
      let me = this;
      axios
        .put("/petss", {


          id: this.id,
           name: this.name,
          category : this.category,
           photoUrls: this.photoUrls,
           tags: this.tags,
           status: this.status,
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

        })
        .catch(function (error) {
          Swal.fire({
            position: "center",
            type: "warning",
            title: "Error (" + error.status + "): " + error,
          });
        });
    },
    deletePets(id) {
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
            .post("/deletepet", {
              id: id,
            })
            .then(function (response) {
              me.listPet();
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
    this.listPet();
      this.listCategory();
      this.listTags();
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
