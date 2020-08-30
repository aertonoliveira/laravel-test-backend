import ApiService from './api.service'

class ContratoService{
 


  cadastrarContrato(data) {
    return ApiService.post('contrato', data);
  }

  conutContratos() {
    return ApiService.get('contratos');
  }
  
}

export default new ContratoService()
