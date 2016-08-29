using System;

namespace GeoRent.Domain.Entities
{
    public class UserImage
    {
        public UserImage()
        {
            idUserImage = Guid.NewGuid();
        }

        public Guid idUserImage { get; set; }
        public String path { get; set; }
        public int resource { get; set; }
        public int order { get; set; }
        public virtual User idUser { get; set; }
    }
}