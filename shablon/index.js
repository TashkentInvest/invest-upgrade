let companyKubmetr = 1
let minimumWage = 375000
let generatePrice = companyKubmetr * minimumWage;

let percentageInput = 20
let quarterlyInput = 6


if (percentageInput) {
    let z = (generatePrice * percentageInput) / 100;
    let n = generatePrice - z;

    if (quarterlyInput) {
        let y = n / quarterlyInput;
        console.log(y)
        console.log('kopaygan 6: ',y * 6)
        console.log('qoshilgam 6: ',y )

                
        x = Math.floor(y)
        
        console.log('x: ', x * 6)
    }
}



console.log(1000 / 6)

console.log('qoshlgan: ',166.66666666666666 + 166.66666666666666 + 166.66666666666666 + 166.66666666666666 + 166.66666666666666 + 166.66666666666666)
console.log('kopaygan: ',166.66666666666666 * 6)



// let x = 4.59;
// let z = Math.floor(x);
// console.log("Converted value of " + x + " is " + z);
