
export function useError(obj){
    let lstError = []
    if(Object.keys(obj).length>0){
        Object.keys(obj).forEach(element => {
           lstError.push(obj[element])
       });
      
    }
    

    return lstError
}