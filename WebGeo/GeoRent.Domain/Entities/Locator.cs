using System;

namespace GeoRent.Domain.Entities
{
    public class Locator : User
    {
        public Locator()
        {
            base.idUser = idUser;
        }
        public virtual Location idLocation { get; set; }
    }
}