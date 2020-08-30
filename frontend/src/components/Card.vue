<template>
    <b-card-group deck> 
      <b-card bg-variant="primary" text-variant="white" header="Numero de Imoveis Cadastrados" class="text-center">
        <b-card-text>{{getImoveis}}</b-card-text>
      </b-card>

      <b-card bg-variant="success" text-variant="white" header="Numero de Contrados Realizados" class="text-center">
        <b-card-text>{{getContratos}}</b-card-text>
      </b-card>
    </b-card-group>
</template>


<script>

export default {
  computed:{
      getImoveis(){
          return this.$store.state.imovel.count_imoveis
      },
      getContratos(){
          return this.$store.state.contrato.count_contratos
      },
  },
  created() {
    this.$store.dispatch('countContratos') 
    this.$store.dispatch('countImoveis') 
  },

 
};

</script>

<style scoped>

</style>