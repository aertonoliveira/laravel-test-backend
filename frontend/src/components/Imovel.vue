<template>
      <ValidationObserver v-slot="{invalid}">
        <div class="modal-body">
            <form >
                <div class="mb-4">
                    <ValidationProvider name="imovel.email" rules="required|email" tag="div" v-slot="{ errors }">
                        <label for="" class="label">
                            Email do proprietário <span class="text-danger">*</span>
                        </label>
                        <input v-model="imovel.email" type="email" class="form-control" placeholder="email@dominio.com" ref="email"/>
                        <div v-if="errors.length>0" class="text-danger ">{{ errors[0] }}</div>
                    </ValidationProvider>
                </div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <ValidationProvider name="imovel.rua" rules="required" tag="div" v-slot="{ errors }">
                                <label class="label" for="">
                                    Rua <span class="text-danger">*</span>
                                </label>
                                <input v-model="imovel.rua" class="form-control" type="text" placeholder="Rua, Avenida, Travessa, etc.">
                                <div v-if="errors.length>0" class="text-danger ">{{ errors[0] }}</div>
                            </ValidationProvider>
                        </div>
                        <div class="col-md-6">
                            <label class="label" for="">
                                Número
                            </label>
                            <input v-model="imovel.numero" class="form-control" type="text">
                        </div>
                        <div  class="text-danger px-3"></div>
                    </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="label" for="">
                            Complemento
                        </label>
                        <input v-model="imovel.complemento" class="form-control" type="text">
                    </div>
                    
                    <div class="col-md-6">
                        <ValidationProvider name="imovel.bairro" rules="required" tag="div" v-slot="{ errors }">
                            <label class="label" for="">
                                Bairro <span class="text-danger">*</span>
                            </label>
                            <input v-model="imovel.bairro" class="form-control" type="text">
                            <div v-if="errors.length>0" class="text-danger ">{{ errors[0] }}</div>
                        </ValidationProvider>
                        
                    </div>                    
                </div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <ValidationProvider name="imovel.estado_id" rules="required" tag="div" v-slot="{ errors }">
                                <label for="" class="label">Estado<span class="text-danger">*</span></label>
                                <select class="form-control" v-model="imovel.estado_id" @change="buscarCidades($event)">
                                    <option  v-for="item in getEstados" :value="item.id" :key="item.id">{{item.estado}}</option>
                                </select>
                                <div v-if="errors.length>0" class="text-danger ">{{ errors[0] }}</div>
                            </ValidationProvider>
                        </div>
                        <div class="col-md-6">
                             <ValidationProvider name="imovel.cidade_id" rules="required" tag="div" v-slot="{ errors }">
                                <label for="" class="label">Cidade <span class="text-danger">*</span></label>
                                <select class="form-control" :disabled="loadingCidades" v-model="imovel.cidade_id" >
                                    <option value="0">Selecione uma cidade</option>
                                    <option  v-for="item in getCidades" :value="item.id" :key="item.id">{{item.cidade}}</option>
                                </select>
                                <div v-if="errors.length>0" class="text-danger ">{{ errors[0] }}</div>
                            </ValidationProvider>
                        </div>
                    </div>
                
            </form>
        </div>
        <div class="modal-footer">
               <b-overlay :show="loadingCadastro" rounded opacity="0.6" spinner-small spinner-variant="primary" class="d-inline-block">
                    <button @click.prevent.stop="cadastroImovel" href="#" class="btn btn-primary" :disabled="invalid">Salvar</button>
               </b-overlay>
        </div>
        </ValidationObserver>
</template>

<script>
 /* eslint-disable */
import { ValidationProvider,  ValidationObserver } from "vee-validate";
import { extend } from "vee-validate";
import { required, email, is_not } from "vee-validate/dist/rules";

extend("required", {
  ...required,
  message: "Campo obrigatório",
});

extend("email", {
  ...email,
  message: "Email inválido",
});

extend("is_not", {
  ...is_not,
  message: "Inválido",
});

export default {
  props: {},
   data() {
    return {
      invalid:true,  
      imoveis: [],
      loadingImoveis: false,
      imovel: {
        email: null,
        rua: null,
        complemento: null,
        bairro: null,
        estado_id: null,
        cidade_id: null,
      },
    };
  },
  methods: {
      buscarCidades(event){
          this.$store.dispatch('consultaCidades',event.target.value) 
      },
      cadastroImovel(){
          this.$store.dispatch('cadastrarImovel',this.imovel) 
      }  
  },
  computed: {
      getEstados(){
          return this.$store.state.estadoCidade.estados
      },
      getCidades(){
          return this.$store.state.estadoCidade.cidades
      },
       loadingCidades(){
          return this.$store.state.estadoCidade.loadingCidades
      },
      loadingCadastro(){
          return this.$store.state.imovel.loading_cadastro
      }

  },
  created() {
    this.$store.dispatch('consultaEstados') 
  },
  components: {
    ValidationProvider,
    ValidationObserver,
  },
};


</script>