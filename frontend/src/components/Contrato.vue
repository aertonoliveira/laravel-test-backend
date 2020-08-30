<template>
  <div>
    <ValidationObserver v-slot="{invalid  }">
   
    <div class="modal-body">
      <div v-if="!semImoveis" class="bg-gray-200 p-4 text-gray-600 rounded text-center">
              Não existem imóveis disponíveis para contratação.
          </div>
        <form v-else class="px-2 pt-2 pb-2 mb-4">
            <div class="mb-4">
            <ValidationProvider name="contrato.imovel_id" rules="required"  v-slot="{ errors }">
                <label for class="label">
                Imóvel
                <span class="text-danger">*</span>
                </label>
            
                  <select class="form-control" v-model="contrato.imovel_id" >
                    <option  v-for="item in getImoveisNaoAssociados" :value="item.id" :key="item.id">
                    {{item.rua}}, {{item.numero}}, {{item.complemento}}, {{item.bairro}}
                    </option>
                </select>
                  <div v-if="errors.length>0" class="text-danger ">{{ errors[0] }}</div>
            </ValidationProvider>
            </div>

            <div class="row">
              <div class="col-md-4">
                  <ValidationProvider name="contrato.tipo_pessoa" rules="required" tag="div"  v-slot="{ errors }">
                  <label class="label">
                      Pessoa
                      <span class="text-danger">*</span>
                  </label>
                  <br>
                  <label class="inline-block mr-2">
                      <input
                      class="mr-1"
                      v-model="contrato.tipo_pessoa"
                      type="radio"
                      name="tipo_pessoa"
                      value="F"
                      />
                      Física
                  </label>
                  <label class="inline-block mr-2">
                      <input
                      class="mr-1"
                      v-model="contrato.tipo_pessoa"
                      type="radio"
                      name="tipo_pessoa"
                      value="J"
                      />
                      Jurídica
                  </label>
                    <div v-if="errors.length>0" class="text-danger ">{{ errors[0] }}</div>
                  </ValidationProvider>
              </div>

              <div class="col-md-8">
                  <ValidationProvider name="contrato.documento" rules="required"  v-slot="{ errors }" tag="div">
                  <label class="label" for="grid-password">
                      Documento
                      <span class="text-danger">*</span>
                  </label>
                  <input
                      v-model="contrato.documento"
                      v-mask="documentMask"
                      class="form-control"
                      type="text"
                  />
                    <div class="text-danger ">{{ errors[0] }}</div>
                  </ValidationProvider>
              </div>
            </div>
            <div class="row mt-3">
            <div class="col-md-6">
            <ValidationProvider name="contrato.email" rules="required|email" tag="div" v-slot="{ errors }">
                <label for class="label">
                Email do Contratante
                <span class="text-danger">*</span>
                </label>
                <input v-model="contrato.email" class="form-control" type="text" />
                <div v-if="errors.length>0" class="text-danger ">{{ errors[0] }}</div>
            </ValidationProvider>
            </div>

            <div class="col-md-6">
            <ValidationProvider name="contrato.nome_completo" rules="required" v-slot="{ errors }" tag="div">
                <label for class="label">
                Nome do Contratante
                <span class="text-danger">*</span>
                </label>
                <input v-model="contrato.nome_completo" class="form-control" type="text" />
                  <div v-if="errors.length>0" class="text-danger ">{{ errors[0] }}</div>
            </ValidationProvider>
            </div>
            </div>
        </form>
      
    </div>
    <div class="modal-footer">
        <b-overlay :show="loadingCadastro" rounded opacity="0.6" spinner-small spinner-variant="primary" class="d-inline-block">
            <button @click.prevent.stop="cadastroContrato" href="#" class="btn btn-primary" :disabled="invalid">Salvar</button>
        </b-overlay>
        
        <a @click.prevent.stop="close" href="#" class="btn btn-default">Cancelar</a>
    </div>
    </ValidationObserver>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";
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
      contrato: {
        imovel_id: -1,
        tipo_pessoa: "F",
        documento: null,
        email: null,
        nome_completo: null,
      },
    };
  },

  methods: {
      cadastroContrato(){
          this.$store.dispatch('cadastrarContrato',this.contrato) 
      }  
  },
  computed: {
     getImoveisNaoAssociados(){
          return this.$store.state.imovel.imoveis_nao_associados
      },
      semImoveis(){
        return this.$store.state.imovel.imoveis_nao_associados.length > 0;
      },
     loadingCadastro(){
          return this.$store.state.imovel.loading_cadastro
      },
    documentMask() {
      return this.contrato.tipo_pessoa == "F"
        ? "###.###.###-##"
        : "##.###.###/####-##";
    },
  },
   created() {
    this.$store.dispatch('consultarImoveisNaoAssociados') 
  },

 
  components: {
    ValidationProvider,
    ValidationObserver,
  },
};

// function makeOptions(item) {
//   return {
//     text: [item.rua, item.numero, item.complemento, item.bairro].join(", "),
//     value: item.id,
//   };
// }
</script>