using System;

namespace GeoRent.Domain.Entities
{
    public class Occupier : User
    {
        public Occupier()
        {
            base.idUser = idUser;
        }

        public int range { get; set; }
        public virtual Location idLocation { get; set; }
    }
}