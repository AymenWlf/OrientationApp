
export default {
  validEmail: function (email) {
    console.log(email);
    var re = /(.+)@(.+){2,}\.(.+){2,}/;
    if (re.test(email?.toLowerCase())) {
      return true;
    }
    return false;
  },
};
