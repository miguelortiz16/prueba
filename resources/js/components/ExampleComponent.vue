

<template>
      <div>


        <div class="container mb-1" >

            <router-link class="btn btn-primary" :to="{ name: 'ingresar' }">Propietarios </router-link>
               <router-link class="btn btn-primary" :to="{ name: 'approval' }">Vehiculos </router-link>
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
     


    };
  },
  computed: {



  },
  methods: {
    



    
 
    
    
   
  },
  mounted() {



  },
};
</script>
<style>



</style>
