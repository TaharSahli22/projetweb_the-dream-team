document.addEventListener('DOMContentLoaded', function() {

  const checkbox = document.getElementById('checkbox');
checkbox.addEventListener('change', ()=>{
  document.body.classList.toggle('dark');
})

  const currency_one = document.getElementById('from');
  const amount = document.getElementById('amt');
  const currency_two = document.getElementById('currency');

    document.querySelector("#fiat-currency").onsubmit = function() {
    {  
      var myHeaders = new Headers();
      myHeaders.append("apikey", "Cmduy7W6307iHxA5b1kgFEymg468JqGB");

      var requestOptions = {
        method: 'GET',
        redirect: 'follow',
        headers: myHeaders
      };

        const from = currency_one.value.toUpperCase();
        const currency = currency_two.value.toUpperCase();
        const amt = amount.value;

        fetch(`https://api.apilayer.com/exchangerates_data/latest?symbols=${currency}&base=${from}`, requestOptions)
        

        .then(response => response.json())
        .then(data => {
          const rate = data.rates[currency];
          const final = rate*amt;
          if (final !== undefined) {
            document.querySelector('#result').innerHTML = `${amt} ${from} is equal to ${final.toFixed(3)} ${currency}.`; 
          } else
          {
            document.querySelector('#result').innerHTML = 'Invalid Currency.';
          }
          
        })
        .catch(error => {
            console.log('Error', error);
        });
      
      return false;
      }
        
    }});

    
