import DataSource from "../data/data-source.js";
const datasource = new DataSource();

const update_purcase = () => {

    $('button#remove_order_item').on('click', function(){
        //select order item, then find the quantity on tbl_order where order_id, 
        //then decrease the quantity to stock on tbl_item where item_code
        //cuz this is page of purcase, this page about restocking (ingcrease) the quantity
        $('#modal-delete_order input#id_order').val($(this).data('id'));
    })
};
export default update_purcase;