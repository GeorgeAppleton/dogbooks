let applyOrder = (elem) => {
    orderPrep((direction, columnNo, table) => {
        let colArray = [];
        let rowArray = [];
        $.each($(table).find('tr'),(key,row) => {
            let cell = $(row).find('td');
            if (cell.length <= 0) {
                return true;
            }
            cell = $(cell).eq(columnNo);
            colArray.push({name : $(cell).text(), order : key-1});//-1 because we miss out the table header with the above if return
            rowArray.push($(row));
        });

        var re = /(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/;
        colArray.sort((a,b) => {
            if (direction == 'asc') {
                if (typeof a.name == "string" && isNaN(a.name)) {
                    if (a.name.match(re)) {//date regex check
                        return new Date(a.name) - new Date(b.name);
                    }
                    return a.name.localeCompare(b.name)*-1;
                } else {
                    return a.name - b.name;
                }
            } else if (direction == 'desc') {
                if (typeof a.name == "string" && isNaN(a.name)) {
                    if (a.name.match(re)) {//date regex check
                        return new Date(b.name) - new Date(a.name);
                    }
                    return a.name.localeCompare(b.name);
                } else {//not a string (somehow, wtf)
                    return b.name - a.name;
                }
            }
        });

        rowArray = rowArray.map(x => {
            return $(x).html();//rowArray to html
        });

        let key = 1;//start at 1 to miss out the table header
        colArray.forEach((value) => {
            $(table).find('tr').eq(key).html(rowArray[value.order]);//set new order by changing html for every row, inserting values from html array using colArrays sorted order
            key++;
        });
    },elem);
};

let orderPrep = (orderQuery,elem) => {
    let columnNo = $(elem).index();//zero-based position column number
    let table = $(elem).closest('table'); //table element

    let stylings = {
        'neutral' : '<i class="icon icon-circle"></i>',
        'desc' : '<i class="icon icon-chevron-circle-down"></i>',
        'asc' : '<i class="icon icon-chevron-circle-up"></i>'
    };

    //apply neutral styling and trigger for changes
    let direction = 'neutral';
    let stylingClass = 'directionStylings';
    $(elem).append("<div class='"+stylingClass+"'>"+stylings[direction]+"</div>");
    let stylingSpan = $(elem).find('.'+stylingClass);
    $(elem).on('click',(event) => {//on click flip direction
        if (direction !== 'desc') {
            direction = 'desc';
        } else {
            direction = 'asc';
        }
        $('.'+stylingClass).not($(stylingSpan)).html(stylings['neutral']);//other directions styling set to neutral
        $(stylingSpan).html(stylings[direction]);//current direction styling set

        orderQuery(direction, columnNo, table);
    });
};

//initialise
let alphClass = '.alphOrder';

$.each($(alphClass), (key,elem) => {
    applyOrder(elem);
});
