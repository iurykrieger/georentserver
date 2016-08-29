using System;

namespace GeoRent.Domain.Entities
{
    public class User
    {
        public User()
        {
            idUser = Guid.NewGuid();
        }

        public Guid idUser { get; set; }
        public String name { get; set; }
        public DateTime birthDate { get; set; }
        public String email { get; set; }
        public String phone { get; set; }
        public String password { get; set; }
        public int credits { get; set; }
        public virtual City idCity { get; set; }
    }
}