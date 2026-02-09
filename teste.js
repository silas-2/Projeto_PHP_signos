// Teste 1: Lógica desnecessariamente complexa
function saoIguais(a,b) {
  return a === b; // simplificado para uma única instrução de retorno
}

// Teste 2: Propriedade duplicada em um objeto
const pessoa = {
  nome: "Ana",
  idade: 30
};

// Teste 3: Atribuição dentro de uma condição (possível bug)
// Teste 3: Atribuição dentro de uma condição (possível bug)
let valor =10;
if (valor === 20) { // usar comparação estrita em vez de atribuição
  console.log("Isso pode não ser o que você espera");
}
