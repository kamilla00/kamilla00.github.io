let checked_type = -1;
function display_on(elem_id)
{
    console.log(elem_id + " display_on");
    document.getElementById(elem_id).style.display = "flex";
}

function display_off(elem_id)
{
    console.log(elem_id + " display_off");
    document.getElementById(elem_id).style.display = "none";
}

function McCombo_extend()
{
    display_on('McCombo_add');
    display_off('case_add');
    checked_type = 0;
}

function case_extend()
{
    display_on('case_add');
    display_off('McCombo_add');
    checked_type = 1;
}

function ice_extend()
{
    display_off('case_add');
    display_off('McCombo_add');
    checked_type = 2;
}

function calculate_price_items()
{
    console.log("Я запустился items");
    let n = document.getElementById("number_items").value;
    if (!isNaN(n) && parseFloat(parseInt(n)) == parseFloat(n) && n >= 1)
    {
        console.log(checked_type);
        switch (checked_type)
        {
            case 0:
            {
                console.log('case0');
                let cost = 199;
                let checkbox_McCombo = document.querySelectorAll('.checkbox_McCombo input[type="checkbox"]');
                for (let i = 0; i < checkbox_McCombo.length; i++) {
                    if (checkbox_McCombo[i].checked) {
                        cost += parseInt(checkbox_McCombo[i].value);
                    }
                }

                cost *= n;
                cost = cost.toFixed(2);
                document.getElementById("result_items").textContent = cost + " руб.";
                break;
            }
            case 1:
            {
                console.log('case1');
                let cost = document.getElementById("colors").value * n;
                cost = cost.toFixed(2);
                document.getElementById("result_items").textContent = cost + " руб.";
                break;
            }
            case 2:
            {
                console.log('case2');
                let cost = 70 * n;
                cost = cost.toFixed(2);
                document.getElementById("result_items").textContent = cost + " руб.";
                break;
            }
        }
    }
    else
    {
        document.getElementById("result_items").textContent = "Неправильный формат ввода кол-ва товара";
    }
}
