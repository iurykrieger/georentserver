using System;
using GeoRent.Domain.Entities;
using System.Collections.Generic;

namespace GeoRent.Domain.Entities
{
    public class City
    {
        public City()
        {
            idCity = Guid.NewGuid();
        }

        public Guid idCity { get; set; }
        public string name { get; set; }
        public String uf { get; set; }
        public virtual List<User> Users {get; set;}
}
}