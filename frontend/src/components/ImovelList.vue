<template>
     <b-row align-h="center" class="mt-5">
      <b-col cols="12">
        <card class="mb-5"></card>
        <b-card class="p-3">
             <b-overlay :show="loadingListagem" rounded="sm">
              <table class="table striped mb-12 text-md">
            <thead>
                <tr>
                    <th><a href="#" @click.prevent.stop="orderBy('email')">Email do proprietário</a></th>
                    <th>Endereço</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="imovel in this.$store.state.imovel.imoveis" :key="imovel.id">
                    <td>{{imovel.email}}</td>
                    <td>{{imovel.bairro}}, {{imovel.numero}}, {{imovel.cidade.cidade}}, {{imovel.estado.estado}}</td>
                    <td width="10%">
                        <span class="badge" 
                            :class="{'badge-success':imovel.status, 'badge-danger': !imovel.status}">
                            <template v-if="imovel.status">Contratado</template>
                            <template v-else>Não contratado</template>
                        </span>
                    </td>
                    <td width="5%">
                        <a title="Apagar"  @click.stop.prevent="" href="" @click="excluir(imovel.id)">
                            remove
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
             </b-overlay>
        
          <b-pagination :total-rows="getTotalPage" 
                        v-on:change="pageChange" 
                        :per-page="getPerPage" 
                        v-model="currentPage"></b-pagination>
        </b-card>
      </b-col>
    </b-row>
</template>

<script>
import Card from './Card'

export default {
  
   data() {
        return {
            currentPage:1,
            pageOfItems: [],
            campo: 'email',
            desc: false
        };
    },
    methods: {
        pageChange (page) {
            this.$store.dispatch('consultarImoveis',page) 
        },
         excluir (id) {
            this.$store.dispatch('excluirImovel',id) 
        },
        orderBy(campo) {
            const payload ={
              desc:  !this.desc ,
              campo: campo
            }
            this.$store.dispatch('filtroImoveis',payload) 
        },
    },
  computed:{
      getImoveis(){
          return this.$store.state.imovel.imoveis
      },
      getPerPage(){
          return this.$store.state.imovel.per_page
      },
      getTotalPage(){
          return this.$store.state.imovel.total_page
      },
      loadingListagem(){
          return this.$store.state.imovel.loading_listagem
      }
  },
  components:{
    Card,
     
  },
   created() {    
      this.$store.dispatch('consultarImoveis',this.currentPage) // dispatch loading

  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
