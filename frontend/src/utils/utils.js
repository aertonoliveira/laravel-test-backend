export default{
    mensagemErro(errors){
        // let errors = e.response.data.errors;
        let mensagem = '';
        for (let field of Object.keys(errors)) {
            console.log(field)
            mensagem += errors[field][0]+"\n";
        } 
        return mensagem;   
    }
}