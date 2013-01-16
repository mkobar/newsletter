if (typeof String.prototype.beginsWith != 'function') {
    String.prototype.beginsWith = function (str){
        return this.lastIndexOf(str, 0) === 0;
    };
}
if (typeof String.prototype.endsWith != 'function') {
    String.prototype.endsWith = function(suffix) {
        return this.indexOf(suffix, this.length - suffix.length) !== -1;
    };
}