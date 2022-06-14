# Agenda

## Tipos de usuario

1. Cliente (reserva citas en la agenda, puede registrarse por si mismo en el sitio web)
2. Administrador (tiene acceso a todas las funcionalidades de administración del sistema backoffice. Administrador del negocio.)
3. Staff (tiene acceso limitado a las funcionalidades del sistema backoffice, ej. ver las reservaciones que debe atender)

## Agenda

1. Las citas deben tener un tiempo de duración. Ej: 30 min, 60 min, 90 min.
2. El tiempo de duración de una cita está determinada por el tipo de servicio para el cual se haya reservado.
3. Cada reservación está relacionada con un miembro del personal que es quien atenderá la cita. El cliente puede elegir al miembro del personal con quien desea reservar la cita.
4. El administrador del sistema puede cancelar y reagendar citas. El staff puede cancelar y reagendar citas si el administrador le ha dado permiso para hacerlo.

## Personal y servicios

1. El personal son los profesionales que atenderán las citas que los clientes hayan reservado. Son usuarios del sistema de tipo **staff.**
2. El número de citas que la agenda puede contener depende de la cantidad de personal disponible y el horario de atención que haya establecido el administrador.
3. Los **servicios** son el tipo de atención que se dará al cliente. Ej: consulta con médico general, tinturado de cabello.
4. El administrador del sistema crea/edita/elimina servicios. A cada servicio se le asigna un tiempo de duración. Se relaciona servicios con los usuarios del **staff** que pueden brindar ese servicio. Ej. Un médico general no debería poder brindar un servicio de psicología.
