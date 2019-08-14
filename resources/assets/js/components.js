import Modal from './components/Modal.vue';
import CreateNote from './components/CreateNote.vue';
import Alert from './components/Alert.vue';
import VcUsers from './components/Users.vue'
import Breadcrum from './components/Breadcrum.vue'
import PanelHeader from './components/PanelHeader.vue'



Vue.component('modal', Modal);
Vue.component('create-note', CreateNote);
Vue.component('alert', Alert);
Vue.component('vc-users', VcUsers);

Vue.component('breadcrum', Breadcrum);
Vue.component('panel-header', PanelHeader);
