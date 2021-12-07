class Modals {

	history(data){
        $('#modal-history table tbody#tbl_history').empty();
        let html = '';
        data.forEach(element => {
            html += `
            <tr>
                <td>${new Date(parseInt(element.date)*1000).toLocaleString()}</td>
                <td>${element.item_id}</td>
                <td>${element.capital_price}</td>
                <td>${element.selling_price}</td>
                <td>${Math.abs(element.quantity)}</td>
                <td>${element.rabate}</td>
                <td>${new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 9 }).format(parseInt((element.selling_price.replace(/[,]|[.]/g,'')*Math.abs(element.quantity)))-parseInt(element.rabate.replace(/[,]|[.]/g,'')))}</td>
            </tr>
            `;
        });
        $('#modal-history table tbody#tbl_history').append(html);
        console.log(data)
    }
}
export default Modals;