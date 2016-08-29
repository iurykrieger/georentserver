using System;

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
    }
}