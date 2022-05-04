export default {
    methods: {
        append_date(_date){
            if (_date?.split("-").length == 2) {
                return `${_date}-01`;
              }
            return _date
        }
    }
}