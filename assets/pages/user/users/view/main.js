import DataSource from "../data/data-source.js";
const datasource = new DataSource();

const main = () => {
	// DataSource.loadData(function(output){})
	datasource.get_roles(function(callback){datasource.jsGrid('#tbl_users', callback)});
};
export default main;