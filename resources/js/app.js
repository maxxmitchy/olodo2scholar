import Alpine from 'alpinejs'
import Focus from '@alpinejs/focus'
import Collapse from "@alpinejs/collapse"
import Persist from "@alpinejs/persist";
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
import AlpineFloatingUI from '@awcodes/alpine-floating-ui'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'

Alpine.plugin(Focus);
Alpine.plugin(Collapse);
Alpine.plugin(Persist);
Alpine.plugin(FormsAlpinePlugin);
Alpine.plugin(AlpineFloatingUI)
Alpine.plugin(NotificationsAlpinePlugin)

window.Alpine = Alpine

Alpine.start()
